<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\AttarPage;
use App\Models\AttarProduct;
use Illuminate\Http\Request;

class AttarPageController extends Controller
{
    public function index()
    {
        $attarPage = AttarPage::first() ?? AttarPage::create([
            'hero_heading' => 'Premium Attar',
            'hero_subheading' => 'Alcohol-free, long-lasting natural fragrances for the discerning',
            'why_choose_title' => 'Why Choose Attar?',
            'why_choose_subtitle' => 'BENEFITS',
            'benefits_section_enabled' => true,
        ]);

        $attarProducts = AttarProduct::orderBy('id', 'desc')->orderBy('sort_order')->get();

        return view('admin.attar-page.index', compact('attarPage', 'attarProducts'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'why_choose_title' => 'nullable|string|max:255',
            'why_choose_subtitle' => 'nullable|string|max:255',
            'benefits_section_enabled' => 'boolean',
        ]);

        $attarPage = AttarPage::first();
        if (!$attarPage) {
            $attarPage = AttarPage::create($validated);
        } else {
            if ($request->hasFile('hero_image')) {
                if ($attarPage->hero_image && file_exists(public_path($attarPage->hero_image))) {
                    unlink(public_path($attarPage->hero_image));
                }
                
                $file = $request->file('hero_image');
                $filename = 'attar-hero-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/attar'), $filename);
                $validated['hero_image'] = 'uploads/attar/' . $filename;
            }
            
            $attarPage->update($validated);
        }

        return redirect()->back()->with('success', 'Attar page settings updated successfully!');
    }

    public function deleteImage(Request $request)
    {
        try {
            $request->validate([
                'image_field' => 'required|in:hero_image',
            ]);

            $imageField = $request->input('image_field');
            $attarPage = AttarPage::first();

            if (!$attarPage) {
                return response()->json(['success' => false, 'message' => 'Attar page not found']);
            }

            $imagePath = $attarPage->$imageField;
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $attarPage->update([$imageField => null]);
            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Unable to delete image']);
        }
    }

    public function storeProduct(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'reviews_count' => 'nullable|integer|min:0',
                'type' => 'required|in:Oud,Floral,Musk,Woody',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'sort_order' => 'nullable|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        }

        // If price not provided, use original_price as price
        if (!$validated['price'] && $validated['original_price']) {
            $validated['price'] = $validated['original_price'];
        }

        // Calculate discount percentage only if both prices are provided and original > price
        if ($validated['price'] && $validated['original_price'] && $validated['original_price'] > $validated['price']) {
            $discount = (($validated['original_price'] - $validated['price']) / $validated['original_price']) * 100;
            $validated['discount_percentage'] = round($discount);
        } else {
            $validated['discount_percentage'] = null;
            $validated['original_price'] = null;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'attar-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/attar-products'), $filename);
            $validated['image'] = 'uploads/attar-products/' . $filename;
        }

        AttarProduct::create($validated);
        
        // Return JSON for AJAX requests, redirect for regular requests
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Attar product added successfully!']);
        }
        return back()->with('success', 'Attar product added successfully!');
    }

    public function updateProduct(Request $request, AttarProduct $attarProduct)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'type' => 'required|in:Oud,Floral,Musk,Woody',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        // If price not provided, use original_price as price
        if (!$validated['price'] && $validated['original_price']) {
            $validated['price'] = $validated['original_price'];
        }

        // Calculate discount percentage only if both prices are provided and original > price
        if ($validated['price'] && $validated['original_price'] && $validated['original_price'] > $validated['price']) {
            $discount = (($validated['original_price'] - $validated['price']) / $validated['original_price']) * 100;
            $validated['discount_percentage'] = round($discount);
        } else {
            $validated['discount_percentage'] = null;
            $validated['original_price'] = null;
        }

        if ($request->hasFile('image')) {
            if ($attarProduct->image && file_exists(public_path($attarProduct->image))) {
                unlink(public_path($attarProduct->image));
            }
            
            $file = $request->file('image');
            $filename = 'attar-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/attar-products'), $filename);
            $validated['image'] = 'uploads/attar-products/' . $filename;
        }

        $attarProduct->update($validated);
        return back()->with('success', 'Attar product updated successfully!');
    }

    public function deleteProductImage(Request $request, AttarProduct $attarProduct)
    {
        try {
            if ($attarProduct->image && file_exists(public_path($attarProduct->image))) {
                unlink(public_path($attarProduct->image));
            }

            $attarProduct->update(['image' => null]);
            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Unable to delete image']);
        }
    }

    public function deleteProduct(AttarProduct $attarProduct)
    {
        if ($attarProduct->image && file_exists(public_path($attarProduct->image))) {
            unlink(public_path($attarProduct->image));
        }
        
        $attarProduct->delete();
        return redirect()->back()->with('success', 'Attar product deleted successfully!');
    }
}

