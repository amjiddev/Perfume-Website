<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Services\JazzCashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class PaymentController extends Controller
{
    protected $jazzCashService;

    public function __construct(JazzCashService $jazzCashService)
    {
        $this->jazzCashService = $jazzCashService;
    }

    /**
     * Initiate Payment
     * POST /api/payments/initiate
     * 
     * Supported payment methods:
     * - jazzcash: JazzCash payment gateway
     * - easypaisa: EasyPaisa payment gateway (coming soon)
     * - cod: Cash on Delivery
     */
    public function initiatePayment(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'zip' => 'required|string|max:10',
                'products' => 'required|array|min:1',
                'total' => 'required|numeric|min:1',
                'notes' => 'nullable|string',
                'payment_method' => 'required|in:jazzcash,easypaisa,cod',
            ]);

            // Handle Cash on Delivery
            if ($validated['payment_method'] === 'cod') {
                return $this->handleCashOnDelivery($validated);
            }

            // Prepare order data
            $orderData = [
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
                'viewed' => false,
            ];

            // Add payment fields if they exist
            if (Schema::hasColumn('orders', 'payment_method')) {
                $orderData['payment_method'] = $validated['payment_method'];
            }
            if (Schema::hasColumn('orders', 'payment_status')) {
                $orderData['payment_status'] = 'pending';
            }

            // Create order in database
            $order = Order::create($orderData);
            
            Log::info('Order created', [
                'order_id' => $order->id,
                'amount' => $validated['total'],
                'payment_method' => $validated['payment_method'],
            ]);

            // Prepare payment data
            $paymentData = [
                'order_id' => $order->id,
                'amount' => $validated['total'],
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'return_url' => route('payment.callback'),
            ];

            // Generate payment form based on method
            if ($validated['payment_method'] === 'jazzcash') {
                $paymentResult = $this->jazzCashService->initiatePayment($paymentData);
                
                if ($paymentResult['success']) {
                    // Store transaction reference
                    if (Schema::hasColumn('orders', 'transaction_id')) {
                        $order->update([
                            'transaction_id' => $paymentResult['txn_ref_no'],
                        ]);
                    }

                    return response()->json([
                        'success' => true,
                        'order_id' => $order->id,
                        'payment_form' => $this->generateJazzCashForm($paymentResult),
                    ], 201);
                }
            } elseif ($validated['payment_method'] === 'easypaisa') {
                // EasyPaisa integration coming soon
                return response()->json([
                    'success' => false,
                    'error' => 'EasyPaisa payment gateway is coming soon',
                ], 400);
            }

            // Delete order if payment initiation failed
            $order->delete();

            return response()->json([
                'success' => false,
                'error' => $paymentResult['error'] ?? 'Payment initiation failed',
            ], 400);

        } catch (\Exception $e) {
            Log::error('Payment Initiation Error', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Payment processing error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Generate JazzCash Payment Form
     */
    private function generateJazzCashForm($paymentData)
    {
        return [
            'type' => 'jazzcash',
            'pp_MerchantID' => $paymentData['merchant_id'],
            'pp_Password' => $paymentData['password'],
            'pp_TxnRefNo' => $paymentData['txn_ref_no'],
            'pp_Amount' => $paymentData['amount'],
            'pp_TxnDateTime' => $paymentData['txn_date_time'],
            'pp_ReturnURL' => $paymentData['return_url'],
            'pp_SecureHash' => $paymentData['secure_hash'],
            'pp_BillReference' => 'Order-' . $paymentData['order_id'],
        ];
    }

    /**
     * Handle Cash on Delivery
     */
    private function handleCashOnDelivery($orderData)
    {
        try {
            $data = [
                'customer_name' => $orderData['customer_name'],
                'email' => $orderData['email'],
                'phone' => $orderData['phone'],
                'address' => $orderData['address'],
                'city' => $orderData['city'],
                'state' => $orderData['state'],
                'zip' => $orderData['zip'],
                'products' => $orderData['products'],
                'total' => $orderData['total'],
                'notes' => $orderData['notes'] ?? '',
                'status' => 'confirmed',
                'viewed' => false,
            ];

            // Add payment fields if they exist
            if (Schema::hasColumn('orders', 'payment_method')) {
                $data['payment_method'] = 'cod';
            }
            if (Schema::hasColumn('orders', 'payment_status')) {
                $data['payment_status'] = 'confirmed';
            }
            if (Schema::hasColumn('orders', 'transaction_id')) {
                $data['transaction_id'] = 'COD-' . time();
            }

            $order = Order::create($data);

            // Send confirmation email
            try {
                Mail::to($order->email)->send(new OrderConfirmation($order));
                Log::info('COD Order Confirmation Email Sent', ['order_id' => $order->id]);
            } catch (\Exception $e) {
                Log::error('Failed to Send Email', ['order_id' => $order->id]);
            }

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'payment_method' => 'cod',
                'message' => 'Order confirmed! You will receive a confirmation email shortly.',
            ]);

        } catch (\Exception $e) {
            Log::error('COD Order Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'error' => 'Failed to create order: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Payment Callback
     * GET /payment/callback
     */
    public function paymentCallback(Request $request)
    {
        try {
            $callbackData = $request->all();

            Log::info('Payment callback received', [
                'txn_ref_no' => $callbackData['pp_TxnRefNo'] ?? null,
            ]);

            // Verify JazzCash callback
            $verifyResult = $this->jazzCashService->verifyCallback($callbackData);

            if (!$verifyResult['success']) {
                Log::warning('Payment verification failed', [
                    'error' => $verifyResult['error'] ?? null,
                ]);

                return redirect()->route('checkout.failure', ['reason' => 'verification_failed']);
            }

            // Find order by transaction ID
            $order = Order::where('transaction_id', $verifyResult['txn_ref_no'])->first();

            if (!$order) {
                return redirect()->route('checkout.failure', ['reason' => 'order_not_found']);
            }

            // Update order based on status
            if ($verifyResult['status'] === 'paid') {
                $updateData = ['status' => 'confirmed'];
                
                if (Schema::hasColumn('orders', 'payment_status')) {
                    $updateData['payment_status'] = 'confirmed';
                }
                
                $order->update($updateData);

                // Send confirmation email
                try {
                    Mail::to($order->email)->send(new OrderConfirmation($order));
                    Log::info('Payment Confirmation Email Sent', ['order_id' => $order->id]);
                } catch (\Exception $e) {
                    Log::error('Failed to Send Email', ['order_id' => $order->id]);
                }

                return redirect()->route('checkout.success', ['order_id' => $order->id]);
            } else {
                $order->update(['status' => 'cancelled']);
                return redirect()->route('checkout.failure', ['reason' => 'payment_failed']);
            }

        } catch (\Exception $e) {
            Log::error('Payment Callback Error', ['error' => $e->getMessage()]);
            return redirect()->route('checkout.failure', ['reason' => 'processing_error']);
        }
    }

    /**
     * Health Check
     * GET /api/payments/health
     */
    public function healthCheck()
    {
        return response()->json([
            'success' => true,
            'message' => 'Payment service is healthy',
            'supported_methods' => ['jazzcash', 'easypaisa', 'cod'],
            'timestamp' => now(),
        ]);
    }
}
