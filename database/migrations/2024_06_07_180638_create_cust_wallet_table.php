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
        Schema::create('cust_wallet', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('WalletCustID');
            $table->string('EWalletBalance');
            $table->string('NoticationID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cust_wallet');
    }
};
