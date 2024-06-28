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
        Schema::create('job_request', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('job_name');
            $table->string('job_description');
            $table->string('job_period')->nullable();
            $table->decimal('initial_price', 8, 2)->default(10.00);
            $table->string('job_address');
            $table->string('job_status');
            $table->string('job_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_request');
    }
};
