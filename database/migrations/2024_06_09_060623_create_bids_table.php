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
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('freelancer_profile_id')->references('id')->on('freelancer_profile')->onDelete('cascade');
            $table->unsignedInteger('job_request_id')->references('id')->on('job_requests')->onDelete('cascade');
            $table->decimal('bid_amount', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
