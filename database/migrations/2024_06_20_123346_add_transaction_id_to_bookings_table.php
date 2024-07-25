<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the column exists before adding it
        if (!Schema::hasColumn('bookings', 'transaction_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->string('transaction_id')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the column if it exists
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
        });
    }
}
