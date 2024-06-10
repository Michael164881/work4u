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
        Schema::create('ewallet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wallet_cust_id')->unsigned()->nullable();
            $table->integer('wallet_flancer_id')->unsigned()->nullable();
            $table->decimal('ewallet_balance', 10, 2)->default(0.00);
            $table->integer('notification_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ewallet');
    }
};
