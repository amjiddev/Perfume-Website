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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Almukhtar Perfume');
            $table->text('company_description')->default('Premium fragrances for the discerning taste.');
            $table->json('quick_links')->nullable();
            $table->json('customer_service_links')->nullable();
            $table->json('social_links')->nullable();
            $table->text('copyright_text')->default('© 2024 Almukhtar Perfume. All rights reserved.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
