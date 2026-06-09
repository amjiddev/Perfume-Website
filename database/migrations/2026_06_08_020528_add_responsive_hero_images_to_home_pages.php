<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            // Hero Image 1 Responsive Variants
            $table->string('hero_image_1_mobile')->nullable()->after('hero_image_1');
            $table->string('hero_image_1_tablet')->nullable()->after('hero_image_1_mobile');
            $table->string('hero_image_1_laptop')->nullable()->after('hero_image_1_tablet');
            
            // Hero Image 2 Responsive Variants
            $table->string('hero_image_2_mobile')->nullable()->after('hero_image_2');
            $table->string('hero_image_2_tablet')->nullable()->after('hero_image_2_mobile');
            $table->string('hero_image_2_laptop')->nullable()->after('hero_image_2_tablet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image_1_mobile',
                'hero_image_1_tablet',
                'hero_image_1_laptop',
                'hero_image_2_mobile',
                'hero_image_2_tablet',
                'hero_image_2_laptop',
            ]);
        });
    }
};
