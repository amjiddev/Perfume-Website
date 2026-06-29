<?php
/**
 * SafePay Token Generation Test
 * Run this file to debug token generation issues
 */

// Load Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// Get credentials from .env
$publicKey = env('SAFEPAY_PUBLIC_KEY');
$secretKey = env('SAFEPAY_SECRET_KEY');
$baseUrl = env('SAFEPAY_BASE_URL', 'https://sandbox.api.getsafepay.com');

echo "=== SafePay Token Generation Test ===\n\n";

// Step 1: Check credentials
echo "Step 1: Checking Credentials\n";
echo "-------------------------------\n";
echo "Public Key: " . (substr($publicKey, 0, 10) . '...') . "\n";
echo "Secret Key: " . (substr($secretKey, 0, 10) . '...') . "\n";
echo "Base URL: " . $baseUrl . "\n";
echo "Endpoint: " . $baseUrl . "/auth/token\n\n";

// Step 2: Test connection
echo "Step 2: Testing Connection to SafePay API\n";
echo "-------------------------------------------\n";

try {
    $response = Http::withBasicAuth($publicKey, $secretKey)
        ->timeout(10)
        ->post($baseUrl . '/auth/token', [
            'grant_type' => 'client_credentials',
        ]);

    echo "HTTP Status: " . $response->status() . "\n";
    echo "Response Headers:\n";
    foreach ($response->headers() as $header => $value) {
        echo "  $header: " . (is_array($value) ? implode(', ', $value) : $value) . "\n";
    }
    echo "\n";

    // Step 3: Parse response
    echo "Step 3: Parsing Response\n";
    echo "-------------------------\n";

    if ($response->successful()) {
        $data = $response->json();
        echo "✅ SUCCESS - Token Generated!\n";
        echo "Access Token: " . (isset($data['access_token']) ? substr($data['access_token'], 0, 20) . '...' : 'NOT FOUND') . "\n";
        echo "Expires In: " . ($data['expires_in'] ?? 'NOT FOUND') . " seconds\n";
        echo "Token Type: " . ($data['token_type'] ?? 'NOT FOUND') . "\n";
    } else {
        echo "❌ FAILED - Status: " . $response->status() . "\n";
        echo "Response Body:\n";
        echo json_encode($response->json(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";

        // Try to extract error message
        $json = $response->json();
        if (isset($json['error'])) {
            echo "\nError: " . $json['error'] . "\n";
        }
        if (isset($json['message'])) {
            echo "Message: " . $json['message'] . "\n";
        }
    }

} catch (\Exception $e) {
    echo "❌ EXCEPTION\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";
?>
