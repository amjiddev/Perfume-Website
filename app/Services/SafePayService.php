<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SafePayService
{
    private $publicKey;
    private $secretKey;
    private $baseUrl;
    private $mode;
    private $accessToken;

    public function __construct()
    {
        $this->publicKey = env('SAFEPAY_PUBLIC_KEY');
        $this->secretKey = env('SAFEPAY_SECRET_KEY');
        $this->baseUrl = env('SAFEPAY_BASE_URL', 'https://sandbox.api.getsafepay.com');
        $this->mode = env('SAFEPAY_MODE', 'sandbox');
    }

    /**
     * Generate SafePay Access Token
     * This MUST be done before any checkout request
     * 
     * @return array
     */
    public function getAccessToken()
    {
        try {
            // Check if token is cached (tokens typically expire in 1 hour)
            $cachedToken = Cache::get('safepay_access_token');
            if ($cachedToken) {
                Log::info('Using cached SafePay token');
                return [
                    'success' => true,
                    'access_token' => $cachedToken,
                ];
            }

            // Verify credentials are set
            if (empty($this->publicKey) || empty($this->secretKey)) {
                Log::error('SafePay credentials not configured', [
                    'has_public_key' => !empty($this->publicKey),
                    'has_secret_key' => !empty($this->secretKey),
                ]);

                return [
                    'success' => false,
                    'error' => 'SafePay credentials not properly configured',
                ];
            }

            // Request new token from SafePay
            Log::info('Requesting new SafePay access token', [
                'endpoint' => $this->baseUrl . '/auth/token',
                'public_key_prefix' => substr($this->publicKey, 0, 10),
            ]);

            try {
                $response = Http::withBasicAuth(
                    $this->publicKey,
                    $this->secretKey
                )->timeout(15)->post($this->baseUrl . '/auth/token', [
                    'grant_type' => 'client_credentials',
                ]);
            } catch (\Exception $e) {
                Log::error('SafePay HTTP request failed', [
                    'error' => $e->getMessage(),
                    'endpoint' => $this->baseUrl . '/auth/token',
                ]);

                return [
                    'success' => false,
                    'error' => 'Connection error: ' . $e->getMessage(),
                ];
            }

            if ($response->successful()) {
                $data = $response->json();
                $accessToken = $data['access_token'] ?? null;
                $expiresIn = $data['expires_in'] ?? 3600; // Default 1 hour

                if ($accessToken) {
                    // Cache the token (slightly less than expires_in to be safe)
                    Cache::put('safepay_access_token', $accessToken, $expiresIn - 60);

                    Log::info('SafePay access token generated successfully', [
                        'expires_in' => $expiresIn,
                        'token_length' => strlen($accessToken),
                    ]);

                    return [
                        'success' => true,
                        'access_token' => $accessToken,
                        'expires_in' => $expiresIn,
                    ];
                }

                // Token not in response
                Log::error('No access token in response', [
                    'response_keys' => array_keys($data),
                ]);

                return [
                    'success' => false,
                    'error' => 'No access token returned from SafePay',
                ];
            }

            // Request failed
            Log::error('Failed to get SafePay access token', [
                'status' => $response->status(),
                'body' => $response->body(),
                'url' => $this->baseUrl . '/auth/token',
                'public_key' => substr($this->publicKey, 0, 10) . '...',
            ]);

            $errorDetails = [];
            try {
                $errorDetails = $response->json();
            } catch (\Exception $e) {
                $errorDetails = ['raw_body' => $response->body()];
            }

            return [
                'success' => false,
                'error' => 'Failed to generate access token (HTTP ' . $response->status() . ')',
                'details' => $errorDetails,
                'status_code' => $response->status(),
            ];

        } catch (\Exception $e) {
            Log::error('SafePay Token Generation Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Create Payment (Checkout Session)
     * IMPORTANT: Requires valid access token
     * 
     * @param array $paymentData
     * @return array
     */
    public function createPaymentOrder($paymentData)
    {
        try {
            // Step 1: Get access token
            $tokenResult = $this->getAccessToken();
            if (!$tokenResult['success']) {
                return $tokenResult;
            }

            $accessToken = $tokenResult['access_token'];

            // Step 2: Convert amount PKR to paisa (multiply by 100)
            $amountInPaisa = (int)(floatval($paymentData['amount']) * 100);

            // Step 3: Prepare checkout payload
            $payload = [
                'amount' => $amountInPaisa,
                'currency' => 'PKR',
                'order_id' => $paymentData['order_id'],
                'description' => $paymentData['description'] ?? 'Order Payment',
                'customer_name' => $paymentData['customer']['name'] ?? '',
                'customer_email' => $paymentData['customer']['email'] ?? '',
                'customer_phone' => $paymentData['customer']['phone'] ?? '',
                'return_url' => $paymentData['return_url'] ?? route('payment.success'),
                'notify_url' => $paymentData['notify_url'] ?? route('api.payments.webhook'),
            ];

            Log::info('Creating SafePay checkout', [
                'order_id' => $paymentData['order_id'],
                'amount' => $paymentData['amount'] . ' PKR',
                'amount_paisa' => $amountInPaisa,
            ]);

            // Step 4: Call SafePay checkout API with Bearer token
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($this->baseUrl . '/checkout', $payload);

            if ($response->successful()) {
                $data = $response->json();

                Log::info('SafePay checkout created successfully', [
                    'order_id' => $paymentData['order_id'],
                    'payment_id' => $data['id'] ?? null,
                    'status' => $data['status'] ?? 'pending',
                ]);

                return [
                    'success' => true,
                    'payment_id' => $data['id'] ?? null,
                    'redirect_url' => $data['redirect_url'] ?? $data['checkout_url'] ?? null,
                    'checkout_url' => $data['checkout_url'] ?? null,
                    'status' => $data['status'] ?? 'pending',
                ];
            }

            Log::error('SafePay checkout creation failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'error' => 'Failed to create checkout',
                'details' => $response->json(),
            ];

        } catch (\Exception $e) {
            Log::error('SafePay Checkout Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get Payment Status
     * Check status of a specific payment
     * 
     * @param string $paymentId
     * @return array
     */
    public function getPaymentStatus($paymentId)
    {
        try {
            $tokenResult = $this->getAccessToken();
            if (!$tokenResult['success']) {
                return $tokenResult;
            }

            $accessToken = $tokenResult['access_token'];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->get($this->baseUrl . '/checkout/' . $paymentId);

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'success' => true,
                    'status' => $data['status'] ?? null,
                    'payment_id' => $data['id'] ?? null,
                    'amount' => $data['amount'] ?? null,
                    'currency' => $data['currency'] ?? null,
                    'order_id' => $data['order_id'] ?? null,
                ];
            }

            Log::error('Failed to get payment status', [
                'payment_id' => $paymentId,
                'status' => $response->status(),
            ]);

            return [
                'success' => false,
                'error' => 'Failed to fetch payment status',
            ];

        } catch (\Exception $e) {
            Log::error('SafePay Status Check Error', [
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify Webhook Signature
     * IMPORTANT: Always verify webhook authenticity
     * 
     * @param array $payload
     * @param string $signature
     * @return bool
     */
    public function verifyWebhookSignature($payload, $signature)
    {
        try {
            // Create signature string from payload (order matters!)
            $signatureString = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            // Generate expected signature using HMAC-SHA256 with secret key
            $expectedSignature = hash_hmac('sha256', $signatureString, $this->secretKey);

            // Constant-time comparison to prevent timing attacks
            $verified = hash_equals($expectedSignature, $signature);

            if (!$verified) {
                Log::warning('SafePay webhook signature verification failed', [
                    'expected' => substr($expectedSignature, 0, 10) . '...',
                    'received' => substr($signature, 0, 10) . '...',
                ]);
            }

            return $verified;

        } catch (\Exception $e) {
            Log::error('Webhook signature verification error', [
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Convert Amount from PKR to Paisa
     * SafePay expects amounts in paisa (1 PKR = 100 paisa)
     * 
     * @param float $amountPkr
     * @return int
     */
    public static function convertToPaisa($amountPkr)
    {
        return (int)(floatval($amountPkr) * 100);
    }

    /**
     * Convert Amount from Paisa to PKR
     * 
     * @param int $amountPaisa
     * @return float
     */
    public static function convertFromPaisa($amountPaisa)
    {
        return (float)($amountPaisa / 100);
    }

    /**
     * Format Amount for Display
     * 
     * @param int $amountPaisa
     * @return string
     */
    public static function formatAmount($amountPaisa)
    {
        return 'PKR ' . number_format(self::convertFromPaisa($amountPaisa), 2);
    }

    /**
     * Get SafePay API Status (Health Check)
     * 
     * @return array
     */
    public function checkApiHealth()
    {
        try {
            $response = Http::get($this->baseUrl . '/health');

            return [
                'success' => $response->successful(),
                'status' => $response->status(),
                'message' => $response->json()['message'] ?? 'OK',
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Log Payment Transaction
     * Internal method for comprehensive logging
     * 
     * @param string $action
     * @param array $data
     */
    private function logTransaction($action, $data)
    {
        Log::info('SafePay Transaction: ' . $action, array_merge($data, [
            'timestamp' => now(),
        ]));
    }
}
