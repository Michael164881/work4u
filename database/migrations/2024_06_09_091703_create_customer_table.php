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
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cust_id');
            $table->string('cust_name');
            $table->char('cust_gender', 1)->nullable();
            $table->integer('cust_age')->unsigned()->nullable();
            $table->string('cust_email')->unique();
            $table->string('cust_phone_no')->nullable();
            $table->string('cust_password');
            $table->string('cust_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
