<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set default display_section for existing perfumes
        DB::table('perfumes')
            ->whereNull('display_section')
            ->update(['display_section' => 'both']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('perfumes')
            ->where('display_section', 'both')
            ->update(['display_section' => null]);
    }
};
