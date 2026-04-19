<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\PerfumePage;
use App\Models\Perfume;
use Illuminate\Http\Request;

class PerfumePageController extends Controller
{
    public function index()
    {
        $perfumePage = PerfumePage::first() ?? PerfumePage::create([
            'hero_heading' => 'Luxury Perfumes',
            'hero_subheading' => 'Discover long-lasting premium fragrances crafted for the modern individual',
            'best_sellers_title' => 'Best Selling Perfumes',
            'best_sellers_subtitle' => 'MOST LOVED',
        ]);

        $perfumes = Perfume::orderBy('sort_order')->get();

        return view('admin.perfume-page.index', compact('perfumePage', 'perfumes'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'best_sellers_title' => 'nullable|string|max:255',
            'best_sellers_subtitle' => 'nullable|string|max:255',
        ]);

        $perfumePage = PerfumePage::first();
        if (!$perfumePage) {
            $perfumePage = PerfumePage::create($validated);
        } else {
            if ($request->hasFile('hero_image')) {
                if ($perfumePage->hero_image && file_exists(public_path($perfumePage->hero_image))) {
                    unlink(public_path($perfumePage->hero_image));
                }
                
                $file = $request->file('hero_image');
                $filename = 'perfume-hero-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/perfume'), $filename);
                $validated['hero_image'] = 'uploads/perfume/' . $filename;
            }
            
            $perfumePage->update($validated);
        }

        return redirect()->back()->with('success', 'Perfume page settings updated successfully!');
    }

    public function storePerfume(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'category' => 'required|in:men,women,unisex,arabic',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'display_section' => 'required|in:perfume,best_seller,both',
        ]);

        // Validate original_price > price only if both are provided
        if (($validated['original_price'] ?? null) && ($validated['price'] ?? null)) {
            if ($validated['original_price'] <= $validated['price']) {
                return back()->withErrors(['price' => 'Sale price must be less than original price.'])->withInput();
            }
            $discount = (($validated['original_price'] - $validated['price']) / $validated['original_price']) * 100;
            $validated['discount_percentage'] = round($discount);
        } else {
            $validated['discount_percentage'] = null;
        }

        // Auto-set is_featured based on display_section
        if ($validated['display_section'] === 'best_seller' || $validated['display_section'] === 'both') {
            $validated['is_featured'] = true;
        } else {
            $validated['is_featured'] = false;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'perfume-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/perfumes'), $filename);
            $validated['image'] = 'uploads/perfumes/' . $filename;
        }

        Perfume::create($validated);
        return back()->with('success', 'Perfume added successfully!');
    }

    public function updatePerfume(Request $request, Perfume $perfume)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'category' => 'required|in:men,women,unisex,arabic',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'display_section' => 'required|in:perfume,best_seller,both',
        ]);

        // Validate original_price > price only if both are provided
        if (($validated['original_price'] ?? null) && ($validated['price'] ?? null)) {
            if ($validated['original_price'] <= $validated['price']) {
                return back()->withErrors(['price' => 'Sale price must be less than original price.'])->withInput();
            }
            $discount = (($validated['original_price'] - $validated['price']) / $validated['original_price']) * 100;
            $validated['discount_percentage'] = round($discount);
        } else {
            $validated['discount_percentage'] = null;
        }

        // Auto-set is_featured based on display_section
        if ($validated['display_section'] === 'best_seller' || $validated['display_section'] === 'both') {
            $validated['is_featured'] = true;
        } else {
            $validated['is_featured'] = false;
        }

        if ($request->hasFile('image')) {
            if ($perfume->image && file_exists(public_path($perfume->image))) {
                unlink(public_path($perfume->image));
            }
            
            $file = $request->file('image');
            $filename = 'perfume-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/perfumes'), $filename);
            $validated['image'] = 'uploads/perfumes/' . $filename;
        }

        $perfume->update($validated);
        return back()->with('success', 'Perfume updated successfully!');
    }

    public function deletePerfume(Perfume $perfume)
    {
        if ($perfume->image && file_exists(public_path($perfume->image))) {
            unlink(public_path($perfume->image));
        }
        
        $perfume->delete();
        return redirect()->back()->with('success', 'Perfume deleted successfully!');
    }


}
