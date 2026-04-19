<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Perfume;
use App\Models\PerfumePage;

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

        // Get perfumes for perfume section (display_section: 'perfume' or 'both')
        $perfumes = Perfume::whereIn('display_section', ['perfume', 'both'])
            ->orderBy('sort_order')
            ->get();

        // Get best sellers (display_section: 'best_seller' or 'both' AND is_featured: true)
        $bestSellers = Perfume::whereIn('display_section', ['best_seller', 'both'])
            ->where('is_featured', true)
            ->orderBy('reviews_count', 'desc')
            ->get();

        return view('frontend.perfumes-dynamic', compact('perfumePage', 'perfumes', 'bestSellers'));
    }
}
