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
        Schema::create('attar_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_heading')->default('Premium Attar');
            $table->text('hero_subheading')->default('Alcohol-free, long-lasting natural fragrances for the discerning');
            $table->string('hero_image')->nullable();
            $table->string('why_choose_title')->default('Why Choose Attar?');
            $table->string('why_choose_subtitle')->default('BENEFITS');
            $table->boolean('benefits_section_enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attar_pages');
    }
};
