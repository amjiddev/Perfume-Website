<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'author' => 'Sarah Khan',
                'email' => 'sarah@example.com',
                'rating' => 5,
                'text' => 'Absolutely love the quality and authenticity. The fragrances last all day and smell amazing. Highly recommended!',
                'display_section' => 'both',
            ],
            [
                'author' => 'Ahmed Hassan',
                'email' => 'ahmed@example.com',
                'rating' => 5,
                'text' => 'Best perfume store in Pakistan. Great customer service and fast delivery. Will definitely order again!',
                'display_section' => 'home',
            ],
            [
                'author' => 'Fatima Ali',
                'email' => 'fatima@example.com',
                'rating' => 5,
                'text' => 'The luxury perfumes here are authentic and worth every penny. Excellent collection and professional service.',
                'display_section' => 'both',
            ],
            [
                'author' => 'Hassan Raza',
                'email' => 'hassan@example.com',
                'rating' => 4.5,
                'text' => 'Great selection of attars. The quality is premium and the prices are reasonable. Very satisfied with my purchase.',
                'display_section' => 'attar',
            ],
            [
                'author' => 'Ayesha Malik',
                'email' => 'ayesha@example.com',
                'rating' => 4,
                'text' => 'Good variety of perfumes. Delivery was quick and packaging was excellent. Will order again soon.',
                'display_section' => 'home',
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
