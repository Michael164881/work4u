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
        Schema::create('booking_status', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('BookingID')->nullable();
            $table->unsignedInteger('FlancerID')->nullable();
            $table->unsignedInteger('CustID')->nullable();
            $table->string('BookingStatus')->nullable();
            $table->integer('NotificationID')->nullable();
            $table->string('BookingStartDate')->nullable();
            $table->string('BookingEndDate')->nullable();
            $table->string('BookingFee')->nullable();
            $table->string('Period')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_status');
    }
};
