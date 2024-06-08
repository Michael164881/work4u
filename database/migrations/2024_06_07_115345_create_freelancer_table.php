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
        Schema::create('freelancer', function (Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('FlancerIC');
            $table->string('FlancerName');
            $table->char('FlancerGender');
            $table->integer('FlancerAge');
            $table->string('FlancerEmail');
            $table->integer('FlancerPhoneNo');
            $table->string('FlancerPassword');
            $table->string('FlancerLocation');
            $table->string('FlancerWorkExperience');
            $table->string('FlancerEduQuality');
            $table->string('FlancerNickname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer');
    }
};
