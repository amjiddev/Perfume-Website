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
        Schema::create('shop_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Shop');
            $table->text('description')->nullable();
            $table->boolean('show_home_page')->default(true);
            $table->boolean('show_about_page')->default(false);
            $table->boolean('show_shop_by_category')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_pages');
    }
};
