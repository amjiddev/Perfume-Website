<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\GuestGift;
use Illuminate\Http\Request;

class GuestGiftController extends Controller
{
    public function index()
    {
        $guestGifts = GuestGift::withoutGlobalScopes()->orderBy('sort_order')->get();

        return view('admin.guest-gift.index', compact('guestGifts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'guest-gift-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/guest-gifts'), $filename);
            $validated['image'] = 'uploads/guest-gifts/' . $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        GuestGift::create($validated);
        return back()->with('success', 'Guest gift added successfully!');
    }

    public function update(Request $request, GuestGift $guestGift)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($guestGift->image && file_exists(public_path($guestGift->image))) {
                unlink(public_path($guestGift->image));
            }
            
            $file = $request->file('image');
            $filename = 'guest-gift-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/guest-gifts'), $filename);
            $validated['image'] = 'uploads/guest-gifts/' . $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $guestGift->update($validated);
        return back()->with('success', 'Guest gift updated successfully!');
    }

    public function delete(GuestGift $guestGift)
    {
        if ($guestGift->image && file_exists(public_path($guestGift->image))) {
            unlink(public_path($guestGift->image));
        }
        
        $guestGift->delete();
        return redirect()->back()->with('success', 'Guest gift deleted successfully!');
    }
}
