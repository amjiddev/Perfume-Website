<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfume_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_heading')->nullable();
            $table->text('hero_subheading')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('best_sellers_title')->nullable();
            $table->string('best_sellers_subtitle')->nullable();
            $table->string('testimonials_title')->nullable();
            $table->string('testimonials_subtitle')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfume_pages');
    }
};
