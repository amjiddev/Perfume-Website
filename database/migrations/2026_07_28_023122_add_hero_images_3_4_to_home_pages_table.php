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
            // Add hero image 3 columns
            $table->string('hero_image_3')->nullable()->after('hero_image_2');
            $table->string('hero_image_3_mobile')->nullable()->after('hero_image_3');
            $table->string('hero_image_3_tablet')->nullable()->after('hero_image_3_mobile');
            $table->string('hero_image_3_laptop')->nullable()->after('hero_image_3_tablet');
            
            // Add hero image 4 columns
            $table->string('hero_image_4')->nullable()->after('hero_image_3_laptop');
            $table->string('hero_image_4_mobile')->nullable()->after('hero_image_4');
            $table->string('hero_image_4_tablet')->nullable()->after('hero_image_4_mobile');
            $table->string('hero_image_4_laptop')->nullable()->after('hero_image_4_tablet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image_3',
                'hero_image_3_mobile',
                'hero_image_3_tablet',
                'hero_image_3_laptop',
                'hero_image_4',
                'hero_image_4_mobile',
                'hero_image_4_tablet',
                'hero_image_4_laptop',
            ]);
        });
    }
};
