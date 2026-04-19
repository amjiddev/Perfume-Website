<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'text' => 'required|string|min:10',
            'display_section' => 'required|in:home,attar,both',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'review-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/reviews'), $filename);
            $validated['image'] = 'uploads/reviews/' . $filename;
        }

        Review::create($validated);
        return back()->with('success', 'Review added successfully!');
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'text' => 'required|string|min:10',
            'display_section' => 'required|in:home,attar,both',
        ]);

        if ($request->hasFile('image')) {
            if ($review->image && file_exists(public_path($review->image))) {
                unlink(public_path($review->image));
            }
            
            $file = $request->file('image');
            $filename = 'review-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/reviews'), $filename);
            $validated['image'] = 'uploads/reviews/' . $filename;
        }

        $review->update($validated);
        return back()->with('success', 'Review updated successfully!');
    }

    public function delete(Review $review)
    {
        if ($review->image && file_exists(public_path($review->image))) {
            unlink(public_path($review->image));
        }
        
        $review->delete();
        return back()->with('success', 'Review deleted successfully!');
    }
}
