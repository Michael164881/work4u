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
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id');
            $table->integer('booking_id')->unsigned();
            $table->integer('wallet_cust_id')->unsigned();
            $table->integer('wallet_flancer_id')->unsigned();
            $table->string('payment_method');
            $table->decimal('amount', 10, 2);
            $table->integer('notification_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
