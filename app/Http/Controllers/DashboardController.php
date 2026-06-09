<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ContactMessage;
use App\Models\EmailSubscription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);
        
        // Get order statistics
        $pendingOrders = Order::where('status', 'pending')->count();
        $approvedOrders = Order::where('status', 'approved')->count();
        $rejectedOrders = Order::where('status', 'rejected')->count();
        
        // Get pending orders for table
        $orders = Order::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Get email subscriptions
        $emailSubscriptions = EmailSubscription::orderBy('created_at', 'desc')->get();
        
        // Get unviewed pending orders
        $orderNotifications = Order::where('status', 'pending')
            ->where('viewed', false)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get unread contact messages
        $messageNotifications = ContactMessage::where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Merge and format notifications
        $notifications = [];
        
        // Add order notifications
        foreach ($orderNotifications as $order) {
            $notifications[] = (object)[
                'id' => 'order-' . $order->id,
                'type' => 'order',
                'title' => 'New Order',
                'message' => 'Order from ' . $order->customer_name,
                'icon' => 'fas fa-shopping-cart',
                'customer_name' => $order->customer_name,
                'email' => $order->email,
                'phone' => $order->phone,
                'address' => $order->address,
                'city' => $order->city,
                'state' => $order->state,
                'zip' => $order->zip,
                'products' => $order->products,
                'total' => $order->total,
                'notes' => $order->notes,
                'status' => $order->status,
                'created_at' => $order->created_at,
            ];
        }
        
        // Add message notifications
        foreach ($messageNotifications as $message) {
            $notifications[] = (object)[
                'id' => 'message-' . $message->id,
                'type' => 'message',
                'title' => 'New Message',
                'message' => 'From ' . $message->name,
                'icon' => 'fas fa-envelope',
                'name' => $message->name,
                'email' => $message->email,
                'phone' => $message->phone,
                'subject' => $message->subject,
                'message_body' => $message->message,
                'is_read' => $message->is_read,
                'created_at' => $message->created_at,
            ];
        }
        
        // Sort notifications by created_at in descending order
        usort($notifications, function ($a, $b) {
            return $b->created_at->timestamp - $a->created_at->timestamp;
        });
        
        return view('admin.dashboard.index', [
            'pendingOrders' => $pendingOrders,
            'approvedOrders' => $approvedOrders,
            'rejectedOrders' => $rejectedOrders,
            'orders' => $orders,
            'emailSubscriptions' => $emailSubscriptions,
            'notifications' => $notifications,
            'dailyLabels' => json_encode([]),
            'dailyData' => json_encode([]),
            'monthlyLabels' => json_encode([]),
            'monthlyData' => json_encode([]),
        ]);
    }
}
