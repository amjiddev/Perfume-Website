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
            'hero_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'why_choose_title' => 'nullable|string|max:255',
            'why_choose_subtitle' => 'nullable|string|max:255',
            'benefits_section_enabled' => 'boolean',
        ]);

        $attarPage = AttarPage::first();
        if (!$attarPage) {
            $attarPage = AttarPage::create($validated);
        } else {
            // Handle old hero_image field
            if ($request->hasFile('hero_image')) {
                // Delete old image
                if ($attarPage->hero_image && file_exists(public_path($attarPage->hero_image))) {
                    unlink(public_path($attarPage->hero_image));
                }
                
                $file = $request->file('hero_image');
                $uniqueId = uniqid() . '-' . time();
                $filename = 'attar-hero-' . $uniqueId . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/attar'), $filename);
                $validated['hero_image'] = 'uploads/attar/' . $filename;
            }
            
            // Handle 4 carousel images
            for ($i = 1; $i <= 4; $i++) {
                $fieldName = 'hero_image_' . $i;
                if ($request->hasFile($fieldName)) {
                    // Delete old image(s)
                    if ($attarPage->$fieldName && file_exists(public_path($attarPage->$fieldName))) {
                        unlink(public_path($attarPage->$fieldName));
                    }
                    
                    // Also clean up any other versions of this carousel image
                    $this->deleteOldCarouselImages('uploads/attar', 'attar-hero-' . $i);
                    
                    $file = $request->file($fieldName);
                    $uniqueId = uniqid() . '-' . time();
                    $filename = 'attar-hero-' . $i . '-' . $uniqueId . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/attar'), $filename);
                    $validated[$fieldName] = 'uploads/attar/' . $filename;
                }
            }
            
            $attarPage->update($validated);
        }

        return redirect()->back()->with('success', 'Attar page settings updated successfully!');
    }

    /**
     * Delete all old versions of carousel images
     */
    private function deleteOldCarouselImages($directory, $prefix)
    {
        $fullPath = public_path($directory);
        
        if (!is_dir($fullPath)) {
            return;
        }

        $files = glob($fullPath . '/' . $prefix . '-*.{jpg,jpeg,png,gif,jfif}', GLOB_BRACE);
        
        foreach ((array)$files as $file) {
            if (file_exists($file) && is_file($file)) {
                try {
                    unlink($file);
                } catch (\Exception $e) {
                    // Log but don't fail if we can't delete a file
                }
            }
        }
    }

    public function deleteImage(Request $request)
    {
        try {
            $request->validate([
                'image_field' => 'required|in:hero_image,hero_image_1,hero_image_2,hero_image_3,hero_image_4',
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
                'original_price' => 'required|numeric|min:0',
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

        // Calculate discount percentage only if sale price is provided and original > sale
        if ($validated['price'] && $validated['original_price'] > $validated['price']) {
            $discount = (($validated['original_price'] - $validated['price']) / $validated['original_price']) * 100;
            $validated['discount_percentage'] = round($discount);
        } else {
            $validated['discount_percentage'] = null;
        }

        // Convert empty price to null
        if (empty($validated['price'])) {
            $validated['price'] = null;
        }

        // Convert empty rating to null
        if (empty($validated['rating'])) {
            $validated['rating'] = null;
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
            'original_price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'type' => 'required|in:Oud,Floral,Musk,Woody',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        // Calculate discount percentage only if sale price is provided and original > sale
        if ($validated['price'] && $validated['original_price'] > $validated['price']) {
            $discount = (($validated['original_price'] - $validated['price']) / $validated['original_price']) * 100;
            $validated['discount_percentage'] = round($discount);
        } else {
            $validated['discount_percentage'] = null;
        }

        // Convert empty price to null
        if (empty($validated['price'])) {
            $validated['price'] = null;
        }

        // Convert empty rating to null
        if (empty($validated['rating'])) {
            $validated['rating'] = null;
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

