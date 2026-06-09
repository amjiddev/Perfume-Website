<?php

namespace Database\Seeders;

use App\Models\FooterSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Force update or create footer settings
        FooterSettings::truncate();
        
        FooterSettings::create([
            'company_name' => 'Almukhtar Perfume',
            'company_description' => 'Premium fragrances for the discerning taste.',
            'quick_links' => [
                ['label' => 'Home', 'url' => 'home'],
                ['label' => 'Shop', 'url' => 'shop'],
                ['label' => 'About', 'url' => 'about'],
            ],
            'customer_service_links' => [
                ['label' => 'Privacy Policy', 'url' => '#'],
                ['label' => 'Terms & Conditions', 'url' => '#'],
                ['label' => 'Disclaimer', 'url' => '#'],
            ],
            'social_links' => [
                ['icon' => 'facebook', 'label' => 'Facebook', 'url' => '#'],
                ['icon' => 'instagram', 'label' => 'Instagram', 'url' => '#'],
                ['icon' => 'tiktok', 'label' => 'TikTok', 'url' => '#'],
            ],
            'copyright_text' => '© 2024 Almukhtar Perfume. All rights reserved.',
        ]);
    }
}
