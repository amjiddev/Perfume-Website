<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\EmailSubscription;
use Illuminate\Http\Request;

class EmailSubscriptionController extends Controller
{
    /**
     * Display list of all email subscriptions
     */
    public function index()
    {
        $subscriptions = EmailSubscription::orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.email-subscriptions.index', compact('subscriptions'));
    }

    /**
     * Delete an email subscription
     */
    public function destroy(EmailSubscription $subscription)
    {
        $subscription->delete();
        
        // Check if this is an AJAX request
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Subscription deleted successfully!'
            ]);
        }
        
        return redirect()->route('admin.email-subscriptions.index')
            ->with('success', 'Subscription deleted successfully!');
    }

    /**
     * Get latest 6 email subscriptions (for dashboard)
     */
    public static function getLatestSubscriptions($limit = 6)
    {
        return EmailSubscription::orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * Get total subscription count (for dashboard)
     */
    public static function getSubscriptionCount()
    {
        return EmailSubscription::count();
    }
}
