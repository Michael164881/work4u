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
            $table->integer('notification_id');
            $table->integer('wallet_flancer_id')->unsigned()->nullable();
            $table->string('cust_id');
            $table->string('flancer_id');
            $table->string('wallet_cust_id');
            $table->integer('booking_id')->unsigned()->nullable();
            $table->integer('work_profile_id')->unsigned()->nullable();
            $table->integer('payment_id')->unsigned()->nullable();
            $table->text('notification_info');
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
