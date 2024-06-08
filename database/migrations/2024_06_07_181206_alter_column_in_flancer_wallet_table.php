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
        Schema::table('flancer_wallet', function (Blueprint $table) {
            //
            $table->foreign('FlancerID')->references('id')->on('freelancer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flancer_wallet', function (Blueprint $table) {
            //
        });
    }
};
