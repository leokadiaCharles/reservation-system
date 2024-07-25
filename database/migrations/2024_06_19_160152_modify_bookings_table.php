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
 
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the customer_name and customer_email columns
            $table->dropColumn(['customer_name', 'customer_email']);
            
            // Add the user_id column as a foreign key
            $table->foreignId('user_id')->constrained()->after('table_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
