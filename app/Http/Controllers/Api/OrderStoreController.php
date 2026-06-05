<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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
                'status' => 'nullable|in:pending,approved,rejected',
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
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status'] ?? 'pending',
            ]);

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
