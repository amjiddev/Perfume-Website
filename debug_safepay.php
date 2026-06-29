<?php
/**
 * SafePay API Debugging Script
 * This script helps diagnose SafePay API connectivity issues
 */

echo "=== SafePay API Debug Tool ===\n\n";

// Check PHP version and extensions
echo "1. Environment Check:\n";
echo "   PHP Version: " . PHP_VERSION . "\n";
echo "   cURL Extension: " . (function_exists('curl_version') ? 'Installed' : 'NOT INSTALLED') . "\n";
echo "   OpenSSL: " . (extension_loaded('openssl') ? 'Loaded' : 'NOT LOADED') . "\n";
echo "   JSON: " . (function_loaded('json_encode') ? 'Loaded' : 'NOT LOADED') . "\n\n";

// Get environment variables
$publicKey = getenv('SAFEPAY_PUBLIC_KEY');
$secretKey = getenv('SAFEPAY_SECRET_KEY');
$baseUrl = getenv('SAFEPAY_BASE_URL');

echo "2. Configuration:\n";
echo "   Base URL: " . ($baseUrl ? $baseUrl : 'NOT SET') . "\n";
echo "   Public Key: " . (substr($publicKey, 0, 15) . "...") . "\n";
echo "   Secret Key: " . (substr($secretKey, 0, 15) . "...") . "\n\n";

if (!$baseUrl || !$publicKey || !$secretKey) {
    echo "ERROR: Missing required environment variables!\n";
    exit(1);
}

// Test endpoint connectivity
echo "3. Testing Token Endpoint Connectivity:\n";
$tokenUrl = rtrim($baseUrl, '/') . '/auth/token';
echo "   URL: " . $tokenUrl . "\n";

// Prepare Basic Auth
$auth = base64_encode($publicKey . ':' . $secretKey);

// Test with cURL
if (function_exists('curl_version')) {
    echo "   Testing with cURL:\n";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{}');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . $auth,
        'Content-Type: application/json',
        'Accept: application/json',
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    echo "   HTTP Status: " . $httpCode . "\n";
    if ($error) {
        echo "   Error: " . $error . "\n";
    }
    
    if ($response) {
        echo "   Response: " . substr($response, 0, 200) . "...\n";
        $jsonData = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($jsonData['data']['access_token'])) {
                echo "   ✓ Token Retrieved Successfully!\n";
                echo "   Token: " . substr($jsonData['data']['access_token'], 0, 30) . "...\n";
            } else {
                echo "   Response Structure:\n";
                echo "   " . json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
            }
        } else {
            echo "   JSON Parse Error: " . json_last_error_msg() . "\n";
        }
    }
    
    curl_close($ch);
} else {
    echo "   cURL not available, testing with file_get_contents:\n";
    
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => [
                'Authorization: Basic ' . $auth,
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            'content' => '{}',
            'timeout' => 10,
            'ignore_errors' => true,
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ]
    ]);
    
    $response = @file_get_contents($tokenUrl, false, $context);
    
    if ($response === false) {
        echo "   Failed to connect to endpoint\n";
        if (isset($http_response_header)) {
            echo "   Response Headers: " . json_encode($http_response_header) . "\n";
        }
    } else {
        echo "   Response: " . substr($response, 0, 200) . "...\n";
    }
}

echo "\n4. Network Tests:\n";
echo "   Pinging SafePay (DNS resolution):\n";

// Get hostname from URL
$urlParts = parse_url($baseUrl);
$host = $urlParts['host'] ?? '';

if ($host) {
    $ip = gethostbyname($host);
    if ($ip !== $host) {
        echo "   ✓ DNS resolved: " . $host . " -> " . $ip . "\n";
    } else {
        echo "   ✗ DNS resolution failed for: " . $host . "\n";
    }
} else {
    echo "   ✗ Could not parse host from URL\n";
}

echo "\nDebug completed.\n";
?>
