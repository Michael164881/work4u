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
        Schema::table('booking_status', function (Blueprint $table) {
            //
            $table->foreign('FlancerID')->references('id')->on('freelancer');
            $table->foreign('CustID')->references('id')->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_status', function (Blueprint $table) {
            //
        });
    }
};
