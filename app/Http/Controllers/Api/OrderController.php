<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function approve($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            $order->update(['status' => 'approved']);

            return response()->json([
                'success' => true,
                'message' => 'Order approved successfully!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve order'
            ], 500);
        }
    }

    public function reject($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            $order->update(['status' => 'rejected']);

            return response()->json([
                'success' => true,
                'message' => 'Order rejected successfully!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject order'
            ], 500);
        }
    }

    public function pending($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            $order->update(['status' => 'pending']);

            return response()->json([
                'success' => true,
                'message' => 'Order marked as pending successfully!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark order as pending'
            ], 500);
        }
    }

    public function destroy($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order'
            ], 500);
        }
    }

    public function getStatusCounts(Request $request)
    {
        try {
            $pendingCount = Order::where('status', 'pending')
                ->orWhereNull('status')
                ->count();
            
            $approvedCount = Order::where('status', 'approved')->count();
            $rejectedCount = Order::where('status', 'rejected')->count();

            return response()->json([
                'success' => true,
                'pending' => $pendingCount,
                'approved' => $approvedCount,
                'rejected' => $rejectedCount
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch status counts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByStatus(Request $request)
    {
        try {
            $status = $request->query('status', 'pending');
            
            // Handle pending status (includes null status)
            if ($status === 'pending') {
                $orders = Order::where(function($query) {
                    $query->where('status', 'pending')
                          ->orWhereNull('status');
                })->get();
            } else {
                $orders = Order::where('status', $status)->get();
            }

            return response()->json([
                'success' => true,
                'orders' => $orders
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
