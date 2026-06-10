<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AttarPage;
use App\Models\AttarProduct;

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

        // Get attar products - newest first, then by sort order
        $attarProducts = AttarProduct::orderBy('id', 'desc')->orderBy('sort_order')->get();

        return view('frontend.attar-dynamic', compact('attarPage', 'attarProducts'));
    }

    public function show($id)
    {
        $product = AttarProduct::findOrFail($id);
        // Get related products - show all except current product
        $relatedProducts = AttarProduct::where('id', '!=', $product->id)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.attar-detail', compact('product', 'relatedProducts'));
    }
}

