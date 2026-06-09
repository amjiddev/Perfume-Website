<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FooterSettings;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Force update all footer settings
        FooterSettings::query()->update([
            'quick_links' => json_encode([
                ['label' => 'Home', 'url' => 'home'],
                ['label' => 'Shop', 'url' => 'shop'],
                ['label' => 'About', 'url' => 'about'],
            ]),
            'customer_service_links' => json_encode([
                ['label' => 'Privacy Policy', 'url' => '#'],
                ['label' => 'Terms & Conditions', 'url' => '#'],
                ['label' => 'Disclaimer', 'url' => '#'],
            ]),
            'social_links' => json_encode([
                ['icon' => 'facebook', 'label' => 'Facebook', 'url' => '#'],
                ['icon' => 'instagram', 'label' => 'Instagram', 'url' => '#'],
                ['icon' => 'tiktok', 'label' => 'TikTok', 'url' => '#'],
            ]),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
