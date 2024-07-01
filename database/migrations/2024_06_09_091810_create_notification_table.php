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
        Schema::create('notification', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->unsignedInteger('booking_id')->references('id')->on('booking')->onDelete('cascade')->nullable();
            $table->unsignedInteger('work_description_id')->references('id')->on('work_description')->onDelete('cascade')->nullable();
            $table->unsignedInteger('job_request_id')->references('id')->on('job_request')->onDelete('cascade')->nullable();
            $table->unsignedInteger('bids_id')->references('id')->on('bids')->onDelete('cascade')->nullable();
            $table->text('notification_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
