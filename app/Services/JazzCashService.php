<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JazzCashService
{
    private $merchantId;
    private $merchantPassword;
    private $integrityKey;
    private $baseUrl;

    public function __construct()
    {
        $this->merchantId = env('JAZZCASH_MERCHANT_ID');
        $this->merchantPassword = env('JAZZCASH_PASSWORD');
        $this->integrityKey = env('JAZZCASH_INTEGRITY_KEY');
        $this->baseUrl = env('JAZZCASH_BASE_URL', 'https://sandbox.jazzcash.com.pk/ApplicationAPI/API/Authentication/DoTransaction');
    }

    /**
     * Generate SecureHash for JazzCash
     * Formula: MD5(MerchantID + Password + pp_TxnRefNo + pp_Amount + pp_TxnDateTime + IntegrityKey)
     */
    private function generateSecureHash($txnRefNo, $amount, $dateTime)
    {
        $hashString = $this->merchantId . $this->merchantPassword . $txnRefNo . $amount . $dateTime . $this->integrityKey;
        return md5($hashString);
    }

    /**
     * Initiate JazzCash Payment
     */
    public function initiatePayment($orderData)
    {
        try {
            // Generate transaction reference
            $txnRefNo = 'TXN-' . uniqid();
            
            // Convert amount to paisa (no decimals)
            $amountInPaisa = (int)($orderData['amount'] * 100);
            
            // Generate transaction datetime
            $txnDateTime = date('YmdHis'); // yyyyMMddHHmmss format
            
            // Generate secure hash
            $secureHash = $this->generateSecureHash($txnRefNo, $amountInPaisa, $txnDateTime);
            
            Log::info('Initiating JazzCash payment', [
                'order_id' => $orderData['order_id'],
                'txn_ref_no' => $txnRefNo,
                'amount' => $orderData['amount'] . ' PKR',
                'amount_paisa' => $amountInPaisa,
            ]);

            return [
                'success' => true,
                'merchant_id' => $this->merchantId,
                'password' => $this->merchantPassword,
                'txn_ref_no' => $txnRefNo,
                'amount' => $amountInPaisa,
                'txn_date_time' => $txnDateTime,
                'secure_hash' => $secureHash,
                'return_url' => $orderData['return_url'] ?? route('payment.callback'),
                'order_id' => $orderData['order_id'],
                'customer_name' => $orderData['customer_name'] ?? '',
                'customer_email' => $orderData['customer_email'] ?? '',
                'customer_phone' => $orderData['customer_phone'] ?? '',
            ];

        } catch (\Exception $e) {
            Log::error('JazzCash Payment Initiation Error', [
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify JazzCash Payment Callback
     */
    public function verifyCallback($callbackData)
    {
        try {
            // Reconstruct the secure hash to verify
            $txnRefNo = $callbackData['pp_TxnRefNo'] ?? '';
            $amount = $callbackData['pp_Amount'] ?? '';
            $txnDateTime = $callbackData['pp_TxnDateTime'] ?? '';
            $receivedHash = $callbackData['pp_SecureHash'] ?? '';
            
            $expectedHash = $this->generateSecureHash($txnRefNo, $amount, $txnDateTime);
            
            Log::info('Verifying JazzCash callback', [
                'txn_ref_no' => $txnRefNo,
                'hash_match' => $expectedHash === $receivedHash,
            ]);

            if ($expectedHash !== $receivedHash) {
                return [
                    'success' => false,
                    'error' => 'Hash verification failed',
                ];
            }

            // Check transaction status
            $status = $callbackData['pp_ResponseCode'] ?? '';
            
            if ($status === '000000') {
                // Success
                return [
                    'success' => true,
                    'status' => 'paid',
                    'txn_ref_no' => $txnRefNo,
                    'amount' => $amount,
                ];
            } else {
                // Failed
                return [
                    'success' => false,
                    'status' => 'failed',
                    'response_code' => $status,
                    'error' => $callbackData['pp_ErrorDescription'] ?? 'Transaction failed',
                ];
            }

        } catch (\Exception $e) {
            Log::error('JazzCash Callback Verification Error', [
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
