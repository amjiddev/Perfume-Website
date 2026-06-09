<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\ShopPage;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    public function index()
    {
        $shopPage = ShopPage::first() ?? ShopPage::create([
            'title' => 'Shop',
            'hero_heading' => 'Our Collection',
            'hero_subheading' => 'Browse our exclusive range of premium fragrances curated for every occasion and personality.',
            'show_home_page' => true,
            'show_about_page' => false,
            'show_shop_by_category' => true,
        ]);

        $products = Product::orderBy('sort_order')->get();

        return view('admin.shop-page.index', compact('shopPage', 'products'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured_products' => 'nullable|json',
            'show_home_page' => 'boolean',
            'show_about_page' => 'boolean',
            'show_shop_by_category' => 'boolean',
        ]);

        $shopPage = ShopPage::first();
        if (!$shopPage) {
            $shopPage = ShopPage::create($validated);
        } else {
            // Handle hero image upload
            if ($request->hasFile('hero_image')) {
                // Delete old image if exists
                if ($shopPage->hero_image && file_exists(public_path($shopPage->hero_image))) {
                    unlink(public_path($shopPage->hero_image));
                }
                
                $file = $request->file('hero_image');
                $filename = 'shop-hero-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/shop'), $filename);
                $validated['hero_image'] = 'uploads/shop/' . $filename;
            }
            
            $shopPage->update($validated);
        }

        return redirect()->back()->with('success', 'Shop page settings updated successfully!');
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0|gt:price',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'category' => 'required|in:men,women,unisex,arabic',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ], [
            'original_price.gt' => 'Original price must be greater than sale price.',
        ]);

        // Auto-calculate discount percentage if original price is provided
        if ($validated['original_price'] ?? null) {
            $discount = (($validated['original_price'] - $validated['price']) / $validated['original_price']) * 100;
            $validated['discount_percentage'] = round($discount);
        } else {
            $validated['discount_percentage'] = null;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['image'] = 'uploads/products/' . $filename;
        }

        Product::create($validated);
        return back()->with('success', 'Product added successfully!');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0|gt:price',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'category' => 'required|in:men,women,unisex,arabic',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ], [
            'original_price.gt' => 'Original price must be greater than sale price.',
        ]);

        // Auto-calculate discount percentage if original price is provided
        if ($validated['original_price'] ?? null) {
            $discount = (($validated['original_price'] - $validated['price']) / $validated['original_price']) * 100;
            $validated['discount_percentage'] = round($discount);
        } else {
            $validated['discount_percentage'] = null;
        }

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            
            $file = $request->file('image');
            $filename = 'product-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['image'] = 'uploads/products/' . $filename;
        }

        $product->update($validated);
        return back()->with('success', 'Product updated successfully!');
    }

    public function deleteImage(Request $request)
    {
        try {
            $request->validate([
                'image_field' => 'required|in:hero_image',
            ]);

            $imageField = $request->input('image_field');
            $shopPage = ShopPage::first();

            if (!$shopPage) {
                return response()->json(['success' => false, 'message' => 'Shop page not found']);
            }

            $imagePath = $shopPage->$imageField;
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $shopPage->update([$imageField => null]);
            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Unable to delete image']);
        }
    }

    public function deleteProductImage(Request $request, Product $product)
    {
        try {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $product->update(['image' => null]);
            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Unable to delete image']);
        }
    }

    public function deleteProduct(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
