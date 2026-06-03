<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Data\Products;

class PerfumeController extends Controller
{
    public function shop()
    {
        $shopPage = \App\Models\ShopPage::first() ?? \App\Models\ShopPage::create([
            'title' => 'Shop',
            'description' => 'Browse our exclusive range of premium fragrances curated for every occasion and personality.',
            'show_home_page' => true,
            'show_about_page' => false,
            'show_shop_by_category' => true,
        ]);
        
        $products = \App\Models\Product::orderBy('sort_order')->get();
        
        return view('frontend.shop', compact('shopPage', 'products'));
    }

    public function perfumes()
    {
        return view('frontend.perfumes');
    }

    public function attar()
    {
        $reviews = \App\Models\Review::whereIn('display_section', ['attar', 'both'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('frontend.attar', compact('reviews'));
    }

    public function about()
    {
        $aboutPage = \App\Models\AboutPage::first() ?? \App\Models\AboutPage::create([
            'title' => 'About Us',
            'hero_heading' => 'About Our Company',
            'hero_subheading' => 'Discover our story, mission, and values.',
            'content_section_1_title' => 'Our Story',
            'content_section_1_description' => 'We are dedicated to providing the finest fragrances and exceptional customer service.',
            'content_section_2_title' => 'Why Choose Us',
            'content_section_2_description' => 'With years of experience, we offer premium quality products at competitive prices.',
            'mission_title' => 'Our Mission',
            'mission_description' => 'To deliver premium fragrances that enhance the lifestyle of our customers.',
            'vision_title' => 'Our Vision',
            'vision_description' => 'To become the leading fragrance provider in the region.',
            'values_title' => 'Our Values',
            'values_description' => 'Quality, Integrity, Customer Satisfaction, and Innovation.',
        ]);
        
        return view('frontend.about', compact('aboutPage'));
    }

    public function contact()
    {
        $contactPage = \App\Models\ContactPage::first() ?? \App\Models\ContactPage::create([
            'title' => 'Contact Us',
            'hero_heading' => 'Get In Touch',
            'hero_subheading' => 'We\'d love to hear from you. Send us a message and we\'ll respond as soon as possible.',
            'description' => 'Have questions about our fragrances? Need assistance with an order? Our dedicated team is here to help.',
            'phone' => '+92 (0) 300 1234567',
            'email' => 'info@almukhtar.com',
            'address' => 'Almukhtar Perfume Store, Main Street, Karachi, Pakistan',
            'office_hours' => 'Monday - Friday: 10:00 AM - 6:00 PM\nSaturday: 11:00 AM - 5:00 PM\nSunday: Closed',
            'contact_form_title' => 'Send us a Message',
            'contact_form_description' => 'Fill out the form below and we\'ll get back to you within 24 hours.',
        ]);
        
        return view('frontend.contact', compact('contactPage'));
    }

    public function productDetail($id)
    {
        $product = Products::getById($id);
        $relatedProducts = Products::getRelated($id);
        
        return view('frontend.product-detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
}
