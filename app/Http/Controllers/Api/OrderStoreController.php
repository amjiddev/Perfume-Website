<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Mail\OrderConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderStoreController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate incoming data
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'zip' => 'required|string|max:20',
                'products' => 'required|array|min:1',
                'total' => 'required|numeric|min:0',
                'notes' => 'nullable|string',
                // Only COD supported now
                'payment_method' => 'nullable|string|in:cod,cash_on_delivery,credit_card,jazzcash,easypaisa',
                'status' => 'nullable|in:pending,approved,rejected',
            ]);

            // Normalize alias values to the actual enum values used in the database
            $paymentMethod = $validated['payment_method'] ?? 'cash_on_delivery';
            if ($paymentMethod === 'cod') {
                $paymentMethod = 'cash_on_delivery';
            }

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
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status'] ?? 'pending',
                'payment_method' => $paymentMethod,
            ]);

            // Send order confirmation email
            try {
                Mail::to($order->email)->send(new OrderConfirmation($order));
                \Log::info('Order confirmation email sent successfully to: ' . $order->email, ['order_id' => $order->id]);
            } catch (\Exception $emailError) {
                \Log::warning('Order email sending failed:', ['error' => $emailError->getMessage(), 'order_id' => $order->id]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order' => $order
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Order creation error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error placing order: ' . $e->getMessage()
            ], 500);
        }
    }
}
