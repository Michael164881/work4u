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
            $table->integer('notification_id');
            $table->integer('wallet_flancer_id')->unsigned()->nullable();
            $table->integer('cust_id')->unsigned()->nullable();
            $table->integer('flancer_id')->unsigned()->nullable();
            $table->integer('wallet_cust_id')->unsigned()->nullable();
            $table->integer('booking_id')->unsigned()->nullable();
            $table->integer('work_profile_id')->unsigned()->nullable();
            $table->integer('payment_id')->unsigned()->nullable();
            $table->text('notification_info');
            $table->timestamps();
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
