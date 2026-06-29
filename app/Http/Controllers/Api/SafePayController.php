<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Services\SafePayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SafePayController extends Controller
{
    protected $safePayService;

    public function __construct(SafePayService $safePayService)
    {
        $this->safePayService = $safePayService;
    }

    /**
     * Initiate SafePay payment
     */
    public function initiate(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'zip' => 'required|string',
                'products' => 'required|array',
                'total' => 'required|numeric|min:0',
                'notes' => 'nullable|string',
                'payment_method' => 'required|in:card,wallet,bank,cod',
            ]);

            // Create order
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'zip' => $validated['zip'],
                'products' => $validated['products'],
                'total' => $validated['total'],
                'notes' => $validated['notes'] ?? '',
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'viewed' => false,
            ]);

            Log::info('Order created', ['order_id' => $order->id, 'amount' => $validated['total']]);

            // Handle Cash on Delivery
            if ($validated['payment_method'] === 'cod') {
                $order->update([
                    'payment_status' => 'confirmed',
                    'transaction_id' => 'COD-' . $order->id,
                ]);

                // Send confirmation email
                try {
                    Mail::to($order->email)->send(new OrderConfirmation($order));
                    Log::info('Order confirmation email sent', ['order_id' => $order->id]);
                } catch (\Exception $e) {
                    Log::error('Failed to send order confirmation email', [
                        'order_id' => $order->id,
                        'error' => $e->getMessage(),
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'method' => 'cash_on_delivery',
                    'order_id' => $order->id,
                    'message' => 'Order confirmed! You will receive a confirmation email shortly.',
                    'redirect_url' => route('checkout.success', ['order_id' => $order->id]),
                ]);
            }

            // For online payment methods, initiate SafePay payment
            $paymentData = [
                'order_id' => $order->id,
                'amount' => $validated['total'],
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'description' => 'Perfume Order #' . $order->id,
            ];

            $paymentResult = $this->safePayService->initiatePayment($paymentData);

            if ($paymentResult['success']) {
                $order->update([
                    'transaction_id' => $paymentResult['transaction_id'],
                ]);

                return response()->json([
                    'success' => true,
                    'method' => $validated['payment_method'],
                    'order_id' => $order->id,
                    'redirect_url' => $paymentResult['redirect_url'],
                    'checkout_id' => $paymentResult['checkout_id'] ?? null,
                ]);
            } else {
                // Delete order if payment initiation failed
                $order->delete();

                return response()->json([
                    'success' => false,
                    'error' => $paymentResult['error'] ?? 'Failed to initiate payment',
                ], 400);
            }
        } catch (\Exception $e) {
            Log::error('SafePay Initiation Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Payment processing error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Payment return/callback from SafePay
     */
    public function returnCallback(Request $request)
    {
        try {
            $checkoutId = $request->get('checkout_id');
            $orderId = $request->get('order_id');

            if (!$checkoutId || !$orderId) {
                return redirect()->route('checkout.failure', ['reason' => 'missing_parameters']);
            }

            // Verify payment status with SafePay
            $verificationResult = $this->safePayService->verifyPayment($checkoutId);

            if (!$verificationResult['success']) {
                return redirect()->route('checkout.failure', ['reason' => 'verification_failed']);
            }

            $paymentStatus = $verificationResult['status'];

            // Update order based on payment status
            $order = Order::find($orderId);
            if (!$order) {
                return redirect()->route('checkout.failure', ['reason' => 'order_not_found']);
            }

            if ($paymentStatus === 'completed' || $paymentStatus === 'COMPLETED') {
                $order->update([
                    'payment_status' => 'confirmed',
                    'status' => 'confirmed',
                ]);

                // Send confirmation email
                try {
                    Mail::to($order->email)->send(new OrderConfirmation($order));
                    Log::info('Order confirmation email sent', ['order_id' => $order->id]);
                } catch (\Exception $e) {
                    Log::error('Failed to send order confirmation email', [
                        'order_id' => $order->id,
                        'error' => $e->getMessage(),
                    ]);
                }

                return redirect()->route('checkout.success', ['order_id' => $order->id]);
            } else {
                $order->update([
                    'payment_status' => 'failed',
                    'status' => 'cancelled',
                ]);

                return redirect()->route('checkout.failure', ['reason' => 'payment_' . strtolower($paymentStatus)]);
            }
        } catch (\Exception $e) {
            Log::error('SafePay Return Callback Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('checkout.failure', ['reason' => 'callback_error']);
        }
    }

    /**
     * Webhook endpoint for SafePay notifications
     */
    public function webhook(Request $request)
    {
        try {
            $payload = $request->json()->all();
            $signature = $request->header('X-Safepay-Signature');

            Log::info('SafePay Webhook Received', ['payload' => $payload, 'signature' => $signature]);

            // Verify webhook signature
            if (!$this->safePayService->verifyWebhookSignature($payload, $signature)) {
                Log::warning('SafePay Webhook Signature Verification Failed', ['signature' => $signature]);
                return response()->json(['success' => false, 'message' => 'Invalid signature'], 401);
            }

            $checkoutId = $payload['id'] ?? null;
            $status = $payload['status'] ?? null;
            $orderId = $payload['order_id'] ?? null;

            if (!$checkoutId || !$orderId) {
                return response()->json(['success' => false, 'message' => 'Missing required fields'], 400);
            }

            $order = Order::find($orderId);
            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Order not found'], 404);
            }

            // Update order based on payment status
            if ($status === 'completed' || $status === 'COMPLETED') {
                $order->update([
                    'payment_status' => 'confirmed',
                    'status' => 'confirmed',
                    'transaction_id' => $checkoutId,
                ]);

                // Send confirmation email if not already sent
                if (!$order->email_sent) {
                    try {
                        Mail::to($order->email)->send(new OrderConfirmation($order));
                        Log::info('Order confirmation email sent via webhook', ['order_id' => $order->id]);
                    } catch (\Exception $e) {
                        Log::error('Failed to send order confirmation email', [
                            'order_id' => $order->id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            } elseif ($status === 'failed' || $status === 'FAILED') {
                $order->update([
                    'payment_status' => 'failed',
                    'status' => 'cancelled',
                ]);
            } else {
                $order->update([
                    'payment_status' => strtolower($status),
                ]);
            }

            Log::info('Webhook processed successfully', ['order_id' => $order->id, 'status' => $status]);

            return response()->json(['success' => true, 'message' => 'Webhook processed']);
        } catch (\Exception $e) {
            Log::error('SafePay Webhook Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
