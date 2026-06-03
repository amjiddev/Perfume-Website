<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Perfume;
use App\Models\PerfumePage;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $shopPage = \App\Models\ShopPage::first();
        $products = \App\Models\Product::where('is_featured', true)->orderBy('sort_order')->limit(6)->get();
        
        // Get perfume page settings for best sellers section
        $perfumePage = PerfumePage::first() ?? PerfumePage::create([
            'hero_heading' => 'Luxury Perfumes',
            'hero_subheading' => 'Discover long-lasting premium fragrances crafted for the modern individual',
            'best_sellers_title' => 'Best Sellers',
            'best_sellers_subtitle' => 'MOST LOVED',
        ]);
        
        // Get best sellers (same as perfume page)
        $bestSellers = Perfume::whereIn('display_section', ['best_seller', 'both'])
            ->where('is_featured', true)
            ->orderBy('reviews_count', 'desc')
            ->limit(3)
            ->get();
        
        // Get reviews for home page
        $reviews = Review::whereIn('display_section', ['home', 'both'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get guest gifts
        $guestGifts = \App\Models\GuestGift::where('is_active', true)->get();
        
        // Get home page settings
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
        
        return view('frontend.home', compact('shopPage', 'products', 'perfumePage', 'bestSellers', 'reviews', 'guestGifts', 'homePage'));
    }
}



