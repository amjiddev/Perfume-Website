<?php

namespace Database\Seeders;

use App\Models\Perfume;
use App\Models\PerfumePage;
use Illuminate\Database\Seeder;

class PerfumeSeeder extends Seeder
{
    public function run(): void
    {
        // Create perfume page settings
        PerfumePage::firstOrCreate(
            ['id' => 1],
            [
                'hero_heading' => 'Luxury Perfumes',
                'hero_subheading' => 'Discover long-lasting premium fragrances crafted for the modern individual',
                'best_sellers_title' => 'Best Selling Perfumes',
                'best_sellers_subtitle' => 'MOST LOVED',
                'testimonials_title' => 'What Our Customers Say',
                'testimonials_subtitle' => 'CUSTOMER REVIEWS',
            ]
        );

        // Sample perfumes data
        $perfumes = [
            [
                'name' => 'Emeraude Noire',
                'description' => 'Bold blend of oud and dark vetiver',
                'price' => 51530,
                'original_price' => 64415,
                'discount_percentage' => 20,
                'rating' => 4.5,
                'reviews_count' => 185,
                'category' => 'men',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Rose Dorée',
                'description' => 'Bulgarian rose with saffron notes',
                'price' => 58380,
                'original_price' => 68815,
                'discount_percentage' => null,
                'rating' => 4.5,
                'reviews_count' => 210,
                'category' => 'women',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Ombre Intense',
                'description' => 'Deep leather and dark spices',
                'price' => 45870,
                'original_price' => 61160,
                'discount_percentage' => 25,
                'rating' => 4,
                'reviews_count' => 165,
                'category' => 'men',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Ambre Royal',
                'description' => 'Rich amber with golden sandalwood',
                'price' => 54210,
                'original_price' => 66215,
                'discount_percentage' => null,
                'rating' => 4.5,
                'reviews_count' => 195,
                'category' => 'unisex',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Fleur de Rose',
                'description' => 'Pink peony and jasmine petals',
                'price' => 61160,
                'original_price' => 78515,
                'discount_percentage' => 22,
                'rating' => 5,
                'reviews_count' => 220,
                'category' => 'women',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Perle Blanche',
                'description' => 'White tea and creamy sandalwood',
                'price' => 66720,
                'original_price' => 75840,
                'discount_percentage' => null,
                'rating' => 4.5,
                'reviews_count' => 240,
                'category' => 'women',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'name' => 'Midnight Elegance',
                'description' => 'Mysterious night fragrance',
                'price' => 52847,
                'original_price' => 66060,
                'discount_percentage' => 20,
                'rating' => 5,
                'reviews_count' => 175,
                'category' => 'unisex',
                'is_featured' => false,
                'sort_order' => 7,
            ],
            [
                'name' => 'Golden Hour',
                'description' => 'Warm and luxurious blend',
                'price' => 50097,
                'original_price' => 61095,
                'discount_percentage' => null,
                'rating' => 4.5,
                'reviews_count' => 198,
                'category' => 'men',
                'is_featured' => false,
                'sort_order' => 8,
            ],
            [
                'name' => 'Ocean Breeze',
                'description' => 'Fresh and crisp marine notes',
                'price' => 48647,
                'original_price' => 57935,
                'discount_percentage' => 16,
                'rating' => 5,
                'reviews_count' => 205,
                'category' => 'unisex',
                'is_featured' => false,
                'sort_order' => 9,
            ],
            [
                'name' => 'Velvet Noir',
                'description' => 'Soft velvet with dark musk',
                'price' => 55000,
                'original_price' => 68750,
                'discount_percentage' => 20,
                'rating' => 4.5,
                'reviews_count' => 180,
                'category' => 'women',
                'is_featured' => false,
                'sort_order' => 10,
            ],
            [
                'name' => 'Jasmine Dreams',
                'description' => 'Exotic jasmine and vanilla',
                'price' => 59500,
                'original_price' => 70000,
                'discount_percentage' => null,
                'rating' => 4.5,
                'reviews_count' => 192,
                'category' => 'women',
                'is_featured' => false,
                'sort_order' => 11,
            ],
            [
                'name' => 'Spice Route',
                'description' => 'Warm spices and oriental notes',
                'price' => 52000,
                'original_price' => 65000,
                'discount_percentage' => 20,
                'rating' => 5,
                'reviews_count' => 188,
                'category' => 'arabic',
                'is_featured' => false,
                'sort_order' => 12,
            ],
        ];

        // Insert perfumes if they don't exist
        foreach ($perfumes as $perfume) {
            Perfume::firstOrCreate(
                ['name' => $perfume['name']],
                $perfume
            );
        }
    }
}
