<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PakPay\PakPay;

class PaymentController extends Controller
{
    protected $pakPay;

    public function __construct()
    {
        $this->pakPay = new PakPay();
    }

    /**
     * Initiate Payment
     * POST /payment/initiate
     */
    public function initiatePayment(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'provider' => 'required|in:jazzcash,easypaisa',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_mobile' => 'nullable|string',
            'cnic_last_6' => 'nullable|string',
            'order_id' => 'nullable|integer',
        ]);

        try {
            Log::info('Payment Initiation', [
                'amount' => $validated['amount'],
                'provider' => $validated['provider'],
            ]);

            // Create payment request
            $paymentData = [
                'provider' => $validated['provider'],
                'amount' => (int)($validated['amount'] * 100), // Convert to lowest unit (paisa/cents)
                'description' => 'Order Payment',
                'return_url' => route('payment.callback'),
                'transaction_reference' => 'ORD-' . time() . rand(100, 999),
                'customer_mobile' => $validated['customer_mobile'] ?? null,
                'customer_cnic_last_6' => $validated['cnic_last_6'] ?? null,
            ];

            // Create payment with PakPay
            $payment = $this->pakPay->createPayment($paymentData);

            // Store payment reference in session
            session([
                'payment_reference' => $paymentData['transaction_reference'],
                'order_id' => $validated['order_id'],
                'payment_amount' => $validated['amount'],
                'payment_provider' => $validated['provider'],
            ]);

            Log::info('Payment Created', ['payment' => $payment]);

            // Handle response based on payment type
            if (isset($payment['redirect_url'])) {
                return redirect($payment['redirect_url']);
            } elseif (isset($payment['redirect_form'])) {
                return response()->json([
                    'success' => true,
                    'form' => $payment['redirect_form'],
                ]);
            } else {
                return back()->with('error', 'Payment initiation failed. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Payment Initiation Error', [
                'error' => $e->getMessage(),
                'provider' => $validated['provider'],
            ]);

            return back()->with('error', 'Payment error: ' . $e->getMessage());
        }
    }

    /**
     * Handle Payment Callback/Webhook
     * POST /payment/callback
     */
    public function handleCallback(Request $request)
    {
        try {
            Log::info('Payment Callback Received', $request->all());

            // Verify the webhook/callback payload
            $response = $this->pakPay->verifyWebhook($request->all());

            if ($response['success']) {
                // Payment successful
                $transactionRef = $response['transaction_ref'] ?? session('payment_reference');
                $orderId = session('order_id');

                if ($orderId) {
                    $order = Order::find($orderId);
                    if ($order) {
                        $order->update([
                            'status' => 'confirmed',
                            'transaction_id' => $response['transaction_id'] ?? null,
                        ]);

                        // Send confirmation email
                        try {
                            Mail::to($order->email)->send(new OrderConfirmation($order));
                            Log::info('Payment Confirmation Email Sent', ['order_id' => $order->id]);
                        } catch (\Exception $e) {
                            Log::error('Email Sending Failed', ['error' => $e->getMessage()]);
                        }
                    }
                }

                // Clear session
                session()->forget(['payment_reference', 'order_id', 'payment_amount', 'payment_provider']);

                return redirect()->route('payment.success')
                    ->with('success', 'Payment completed successfully!')
                    ->with('order_id', $orderId);
            } else {
                // Payment failed or invalid
                Log::warning('Payment Verification Failed', $response);

                if ($orderId) {
                    $order = Order::find($orderId);
                    if ($order) {
                        $order->update(['status' => 'cancelled']);
                    }
                }

                session()->forget(['payment_reference', 'order_id', 'payment_amount', 'payment_provider']);

                return redirect()->route('payment.failed')
                    ->with('error', 'Payment verification failed');
            }
        } catch (\Exception $e) {
            Log::error('Payment Callback Error', ['error' => $e->getMessage()]);

            return redirect()->route('payment.failed')
                ->with('error', 'Verification error: ' . $e->getMessage());
        }
    }

    /**
     * Check Payment Status
     * POST /payment/status
     */
    public function checkStatus(Request $request)
    {
        $validated = $request->validate([
            'provider' => 'required|in:jazzcash,easypaisa',
            'transaction_id' => 'required|string',
        ]);

        try {
            $response = $this->pakPay->getTransactionStatus([
                'provider' => $validated['provider'],
                'transaction_id' => $validated['transaction_id'],
            ]);

            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Payment Status Check Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Payment Success Page
     */
    public function paymentSuccess()
    {
        return view('payment.success');
    }

    /**
     * Payment Failed Page
     */
    public function paymentFailed()
    {
        return view('payment.failed');
    }
}
