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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            // Hero Section
            $table->string('hero_heading')->default('Discover Luxury');
            $table->text('hero_subheading')->default('Experience the finest collection of premium fragrances from around the world. Each scent tells a story of elegance and sophistication.');
            $table->string('hero_image_1')->nullable();
            $table->string('hero_image_2')->nullable();
            // About Us Section
            $table->string('about_heading')->default('Almukhtar Perfume');
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();
            $table->json('about_features')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
