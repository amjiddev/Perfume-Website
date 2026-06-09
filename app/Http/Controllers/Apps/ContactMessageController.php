<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display list of all contact messages
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = ContactMessage::unread()->count();
        
        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Show a specific message
     */
    public function show(ContactMessage $message)
    {
        // Mark as read when viewing
        if (!$message->is_read) {
            $message->markAsRead();
        }
        
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Delete a message
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        
        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully!');
    }

    /**
     * API endpoint for frontend form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.regex' => 'Full name can only contain alphabetic characters and spaces',
            'phone.required' => 'Phone number is required',
        ]);

        // Validate phone has 10-14 digits
        $digitsOnly = preg_replace('/\D/', '', $validated['phone']);
        if (strlen($digitsOnly) < 10 || strlen($digitsOnly) > 14) {
            return response()->json([
                'success' => false,
                'message' => 'Phone number must contain 10-14 digits'
            ], 422);
        }

        try {
            ContactMessage::create($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error submitting message. Please try again.'
            ], 500);
        }
    }
}
