<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        
        // Get notifications (unviewed pending orders)
        $notifications = Order::where('status', 'pending')
            ->where('viewed', false)
            ->orderBy('created_at', 'desc')
            ->get();
        
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
