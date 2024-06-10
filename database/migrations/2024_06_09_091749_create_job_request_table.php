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
            $table->integer('job_request_id');
            $table->integer('customer_id')->unsigned();
            $table->string('job_description');
            $table->string('job_period')->nullable();
            $table->boolean('make_bidding')->default(0);
            $table->timestamps();
        
            
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
