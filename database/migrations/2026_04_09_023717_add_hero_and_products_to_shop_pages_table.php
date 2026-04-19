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
        Schema::table('shop_pages', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->after('description');
            $table->string('hero_heading')->nullable()->after('hero_image');
            $table->text('hero_subheading')->nullable()->after('hero_heading');
            $table->json('featured_products')->nullable()->after('hero_subheading');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_pages', function (Blueprint $table) {
            $table->dropColumn(['hero_image', 'hero_heading', 'hero_subheading', 'featured_products']);
        });
    }
};
