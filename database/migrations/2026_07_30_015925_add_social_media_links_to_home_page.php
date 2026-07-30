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
            $table->string('facebook_link')->nullable()->after('about_features');
            $table->string('youtube_link')->nullable()->after('facebook_link');
            $table->string('tiktok_link')->nullable()->after('youtube_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn('facebook_link');
            $table->dropColumn('youtube_link');
            $table->dropColumn('tiktok_link');
        });
    }
};
