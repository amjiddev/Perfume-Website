<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\City;
use App\Models\Faq;
use App\Models\GuestGift;
use App\Models\HomePage;
use App\Models\LandingPage;
use App\Models\OemContent;
use App\Models\Offer;
use App\Models\Perfume;
use App\Models\PerfumePage;
use App\Models\Product;
use App\Models\RepairService;
use App\Models\RepairServiceSubPage;
use App\Models\ShopPage;
use App\Traits\UploadImageTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LandingPageController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        try {
            $homePage = \App\Models\HomePage::first() ?? \App\Models\HomePage::create([
                'hero_heading' => 'Discover Luxury',
                'hero_subheading' => 'Experience the finest collection of premium fragrances from around the world. Each scent tells a story of elegance and sophistication.',
                'hero_image_1' => 'frontend/images/perfume1.jpg',
                'hero_image_2' => 'frontend/images/perfume2.jpg',
                'about_heading' => 'Almukhtar Perfume',
                'about_description' => 'Almukhtar Perfume represents the pinnacle of luxury fragrance craftsmanship. With decades of expertise in perfumery, we curate the finest collection of long-lasting fragrances from around the world.',
                'about_image' => 'frontend/images/perfume5.jfif',
                'about_features' => [
                    'Premium quality fragrances',
                    'Long-lasting scents',
                    'Authentic & original products',
                    'Expert curation'
                ]
            ]);

            $footerSettings = \App\Models\FooterSettings::first() ?? \App\Models\FooterSettings::create([
                'company_name' => 'Almukhtar Perfume',
                'company_description' => 'Premium fragrances for the discerning taste.',
                'copyright_text' => '© 2024 Almukhtar Perfume. All rights reserved.',
            ]);

            return view('pages.landing-page.index', compact('homePage', 'footerSettings'));
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            abort(403, 'You do not have permission to view this page.');
        } catch (\Throwable $e) {
            Log::error('LandingPage index error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withErrors(['general_error' => 'Unable to load landing page data. Please try again later.']);
        }
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'hero_heading' => 'required|string|max:255',
                'hero_subheading' => 'required|string',
                'hero_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'hero_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'hero_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'hero_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'about_heading' => 'required|string|max:255',
                'about_description' => 'required|string',
                'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'about_features' => 'nullable|array',
                'about_features.*' => 'string|max:255',
                'company_name' => 'required|string|max:255',
                'company_description' => 'required|string',
                'facebook_url' => 'nullable|url',
                'youtube_url' => 'nullable|url',
                'tiktok_url' => 'nullable|url',
            ]);

            // Handle HomePage
            $homePage = \App\Models\HomePage::first();
            if (!$homePage) {
                $homePage = \App\Models\HomePage::create($validated);
            } else {
                // Handle hero image 1
                if ($request->hasFile('hero_image_1')) {
                    if ($homePage->hero_image_1 && file_exists(public_path($homePage->hero_image_1))) {
                        unlink(public_path($homePage->hero_image_1));
                    }
                    
                    $file = $request->file('hero_image_1');
                    $filename = 'hero-1-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home-page'), $filename);
                    $validated['hero_image_1'] = 'uploads/home-page/' . $filename;
                }

                // Handle hero image 2
                if ($request->hasFile('hero_image_2')) {
                    if ($homePage->hero_image_2 && file_exists(public_path($homePage->hero_image_2))) {
                        unlink(public_path($homePage->hero_image_2));
                    }
                    
                    $file = $request->file('hero_image_2');
                    $filename = 'hero-2-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home-page'), $filename);
                    $validated['hero_image_2'] = 'uploads/home-page/' . $filename;
                }

                // Handle hero image 3
                if ($request->hasFile('hero_image_3')) {
                    if ($homePage->hero_image_3 && file_exists(public_path($homePage->hero_image_3))) {
                        unlink(public_path($homePage->hero_image_3));
                    }
                    
                    $file = $request->file('hero_image_3');
                    $filename = 'hero-3-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home-page'), $filename);
                    $validated['hero_image_3'] = 'uploads/home-page/' . $filename;
                }

                // Handle hero image 4
                if ($request->hasFile('hero_image_4')) {
                    if ($homePage->hero_image_4 && file_exists(public_path($homePage->hero_image_4))) {
                        unlink(public_path($homePage->hero_image_4));
                    }
                    
                    $file = $request->file('hero_image_4');
                    $filename = 'hero-4-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home-page'), $filename);
                    $validated['hero_image_4'] = 'uploads/home-page/' . $filename;
                }

                // Handle about image
                if ($request->hasFile('about_image')) {
                    if ($homePage->about_image && file_exists(public_path($homePage->about_image))) {
                        unlink(public_path($homePage->about_image));
                    }
                    
                    $file = $request->file('about_image');
                    $filename = 'about-' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home-page'), $filename);
                    $validated['about_image'] = 'uploads/home-page/' . $filename;
                }

                $homePage->update($validated);
            }

            // Handle FooterSettings with social media URLs
            $footerSettings = \App\Models\FooterSettings::first();
            $footerData = [
                'company_name' => $validated['company_name'],
                'company_description' => $validated['company_description'],
                'facebook_url' => $validated['facebook_url'] ?? null,
                'youtube_url' => $validated['youtube_url'] ?? null,
                'tiktok_url' => $validated['tiktok_url'] ?? null,
            ];

            if (!$footerSettings) {
                \App\Models\FooterSettings::create($footerData);
            } else {
                $footerSettings->update($footerData);
            }

            return redirect()->back()->with('success', 'Home page and footer settings updated successfully!');
        } catch (\Throwable $e) {
            Log::error('LandingPage update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withErrors(['general_error' => 'Unable to update landing page. Please try again later.']);
        }
    }

    public function deleteImage(Request $request)
    {
        try {
            $request->validate([
                'image_field' => 'required|in:hero_image_1,hero_image_2,hero_image_3,hero_image_4,about_image',
            ]);

            $imageField = $request->input('image_field');
            $homePage = \App\Models\HomePage::first();

            if (!$homePage) {
                return response()->json(['success' => false, 'message' => 'Home page not found']);
            }

            // Get the current image path
            $imagePath = $homePage->$imageField;

            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            // Update the image field to null
            $homePage->update([$imageField => null]);

            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Throwable $e) {
            Log::error('Delete image error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['success' => false, 'message' => 'Unable to delete image']);
        }
    }

    public function landingPage()
    {
        $shopPage = \App\Models\ShopPage::first();
        $products = \App\Models\Product::where('is_featured', true)->orderBy('sort_order')->limit(6)->get();
        
        // Get perfume page settings for best sellers section
        $perfumePage = \App\Models\PerfumePage::first() ?? \App\Models\PerfumePage::create([
            'hero_heading' => 'Luxury Perfumes',
            'hero_subheading' => 'Discover long-lasting premium fragrances crafted for the modern individual',
            'best_sellers_title' => 'Best Sellers',
            'best_sellers_subtitle' => 'MOST LOVED',
        ]);
        
        // Get best sellers (same as perfume page)
        $bestSellers = \App\Models\Perfume::whereIn('display_section', ['best_seller', 'both'])
            ->where('is_featured', true)
            ->orderBy('reviews_count', 'desc')
            ->limit(3)
            ->get();
        
        // Get guest gifts
        $guestGifts = \App\Models\GuestGift::where('is_active', true)->orderBy('sort_order')->limit(3)->get();
        
        // Get home page settings
        $homePage = \App\Models\HomePage::first() ?? \App\Models\HomePage::create([
            'hero_heading' => 'Discover Luxury',
            'hero_subheading' => 'Experience the finest collection of premium fragrances from around the world. Each scent tells a story of elegance and sophistication.',
            'about_heading' => 'Almukhtar Perfume',
            'about_description' => 'Almukhtar Perfume represents the pinnacle of luxury fragrance craftsmanship. With decades of expertise in perfumery, we curate the finest collection of long-lasting fragrances from around the world.',
            'about_features' => [
                'Premium quality fragrances',
                'Long-lasting scents',
                'Authentic & original products',
                'Expert curation'
            ]
        ]);
        
        return view('pages.landing-page.index', compact('shopPage', 'products', 'perfumePage', 'bestSellers', 'reviews', 'guestGifts', 'homePage'));
    }
}
