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
        Schema::table('attar_pages', function (Blueprint $table) {
            // Add hero_image_1, hero_image_2, hero_image_3, hero_image_4 columns
            $table->string('hero_image_1')->nullable()->after('hero_subheading');
            $table->string('hero_image_2')->nullable()->after('hero_image_1');
            $table->string('hero_image_3')->nullable()->after('hero_image_2');
            $table->string('hero_image_4')->nullable()->after('hero_image_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attar_pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image_1',
                'hero_image_2',
                'hero_image_3',
                'hero_image_4',
            ]);
        });
    }
};
