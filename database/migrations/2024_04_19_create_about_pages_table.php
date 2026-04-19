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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('hero_heading')->nullable();
            $table->text('hero_subheading')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('content_section_1_title')->nullable();
            $table->text('content_section_1_description')->nullable();
            $table->string('content_section_1_image')->nullable();
            $table->string('content_section_2_title')->nullable();
            $table->text('content_section_2_description')->nullable();
            $table->string('content_section_2_image')->nullable();
            $table->string('mission_title')->nullable();
            $table->text('mission_description')->nullable();
            $table->string('vision_title')->nullable();
            $table->text('vision_description')->nullable();
            $table->string('values_title')->nullable();
            $table->text('values_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
