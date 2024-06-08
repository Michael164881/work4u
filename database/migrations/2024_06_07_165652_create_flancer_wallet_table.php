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
        Schema::create('flancer_wallet', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('WalletFlancerID');
            $table->string('EWalletBalance');
            $table->string('NotificationID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flancer_wallet');
    }
};
