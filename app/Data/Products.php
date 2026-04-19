<?php

namespace App\Data;

class Products
{
    public static function getAll()
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'Emeraude Noire',
                'image' => 'frontend/images/perfume2.jpg',
                'price' => 51530,
                'original_price' => 64415,
                'discount' => 20,
                'rating' => 5,
                'reviews' => 128,
                'description' => 'A bold blend of oud, dark vetiver and smoky amber. This luxurious fragrance captures the essence of sophistication and elegance. Perfect for those who appreciate the finer things in life.',
                'long_description' => 'Emeraude Noire is a masterpiece of perfumery, crafted with the finest ingredients from around the world. This exquisite fragrance opens with top notes of bergamot and black pepper, creating an immediate sense of intrigue and sophistication. The heart of the fragrance reveals a complex blend of oud and dark vetiver, providing depth and character. These middle notes create a captivating aura that lingers throughout the day. The base notes of smoky amber and sandalwood provide a warm, sensual finish that makes this fragrance truly unforgettable. Perfect for evening wear or special occasions.',
                'brand' => 'Almukhtar Perfume',
                'volume' => '100 ml',
                'type' => 'Eau de Parfum',
                'family' => 'Oriental',
                'top_notes' => 'Bergamot, Black Pepper',
                'heart_notes' => 'Oud, Dark Vetiver',
                'base_notes' => 'Smoky Amber, Sandalwood',
                'longevity' => '8-10 hours',
                'sillage' => 'Strong',
            ],
            2 => [
                'id' => 2,
                'name' => 'Rose Dorée',
                'image' => 'frontend/images/perfume3.jfif',
                'price' => 58380,
                'original_price' => 68815,
                'discount' => 0,
                'rating' => 5,
                'reviews' => 95,
                'description' => 'Bulgarian rose with hints of saffron and warm musk. An elegant and timeless fragrance that celebrates the beauty of nature.',
                'long_description' => 'Rose Dorée is an ode to the timeless beauty of Bulgarian roses. This exquisite fragrance opens with fresh rose petals, enhanced by delicate hints of saffron that add a touch of exotic spice. The heart reveals a beautiful blend of rose and jasmine, creating a romantic and sophisticated aura. The base notes of warm musk and sandalwood provide a sensual and lasting finish. This fragrance is perfect for those who appreciate classic elegance with a modern twist.',
                'brand' => 'Almukhtar Perfume',
                'volume' => '100 ml',
                'type' => 'Eau de Parfum',
                'family' => 'Floral',
                'top_notes' => 'Bulgarian Rose, Saffron',
                'heart_notes' => 'Rose, Jasmine',
                'base_notes' => 'Warm Musk, Sandalwood',
                'longevity' => '7-9 hours',
                'sillage' => 'Moderate',
            ],
            3 => [
                'id' => 3,
                'name' => 'Ombre Intense',
                'image' => 'frontend/images/perfume6.jfif',
                'price' => 45870,
                'original_price' => 61160,
                'discount' => 25,
                'rating' => 5,
                'reviews' => 112,
                'description' => 'Deep leather, dark spices and a touch of incense. A mysterious and captivating fragrance for the bold.',
                'long_description' => 'Ombre Intense is a bold and mysterious fragrance that captures the essence of sophistication. This fragrance opens with dark spices and a hint of incense, creating an immediate sense of intrigue. The heart reveals a complex blend of leather and oud, providing depth and character. The base notes of dark amber and vetiver create a warm and sensual finish. This fragrance is perfect for evening wear and special occasions, ideal for those who dare to be different.',
                'brand' => 'Almukhtar Perfume',
                'volume' => '100 ml',
                'type' => 'Eau de Parfum',
                'family' => 'Oriental',
                'top_notes' => 'Dark Spices, Incense',
                'heart_notes' => 'Leather, Oud',
                'base_notes' => 'Dark Amber, Vetiver',
                'longevity' => '9-11 hours',
                'sillage' => 'Strong',
            ],
            4 => [
                'id' => 4,
                'name' => 'Ambre Royal',
                'image' => 'frontend/images/perfume7.jfif',
                'price' => 54210,
                'original_price' => 66215,
                'discount' => 0,
                'rating' => 5,
                'reviews' => 87,
                'description' => 'Rich amber, vanilla orchid and golden sandalwood. A luxurious and warm fragrance for the discerning.',
                'long_description' => 'Ambre Royal is a luxurious fragrance that celebrates the richness of amber and the warmth of sandalwood. This exquisite fragrance opens with top notes of bergamot and vanilla orchid, creating a sweet and inviting aura. The heart reveals a beautiful blend of amber and rose, providing depth and elegance. The base notes of golden sandalwood and musk create a warm and sensual finish that lasts throughout the day. This fragrance is perfect for both day and evening wear, ideal for those who appreciate luxury and sophistication.',
                'brand' => 'Almukhtar Perfume',
                'volume' => '100 ml',
                'type' => 'Eau de Parfum',
                'family' => 'Amber',
                'top_notes' => 'Bergamot, Vanilla Orchid',
                'heart_notes' => 'Amber, Rose',
                'base_notes' => 'Golden Sandalwood, Musk',
                'longevity' => '8-10 hours',
                'sillage' => 'Moderate',
            ],
        ];
    }

    public static function getById($id)
    {
        $products = self::getAll();
        return $products[$id] ?? null;
    }

    public static function getRelated($id, $limit = 4)
    {
        $products = self::getAll();
        $related = [];
        foreach ($products as $product) {
            if ($product['id'] != $id) {
                $related[] = $product;
            }
        }
        return array_slice($related, 0, $limit);
    }
}
