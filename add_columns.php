<?php
/**
 * Quick script to add payment columns to orders table
 * Run from command line: php add_columns.php
 */

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

try {
    // Check if payment_method column exists
    if (!Schema::hasColumn('orders', 'payment_method')) {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status');
        });
        echo "✓ Added payment_method column\n";
    } else {
        echo "✓ payment_method column already exists\n";
    }

    // Check if payment_status column exists
    if (!Schema::hasColumn('orders', 'payment_status')) {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('pending')->after('payment_method');
        });
        echo "✓ Added payment_status column\n";
    } else {
        echo "✓ payment_status column already exists\n";
    }

    // Check if transaction_id column exists
    if (!Schema::hasColumn('orders', 'transaction_id')) {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('payment_status');
        });
        echo "✓ Added transaction_id column\n";
    } else {
        echo "✓ transaction_id column already exists\n";
    }

    // Check if viewed column exists
    if (!Schema::hasColumn('orders', 'viewed')) {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('viewed')->default(false)->after('payment_status');
        });
        echo "✓ Added viewed column\n";
    } else {
        echo "✓ viewed column already exists\n";
    }

    echo "\n✓ All columns added successfully!\n";

} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
