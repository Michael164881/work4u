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
            $table->increments('id');
            $table->timestamps();
            $table->string('flancer_id');
            $table->string('flancer_name');
            $table->char('flancer_gender', 1)->nullable();
            $table->integer('flancer_age')->unsigned()->nullable();
            $table->string('flancer_email')->unique();
            $table->string('flancer_phone_no')->nullable();
            $table->string('flancer_password');
            $table->string('flancer_location')->nullable();
            $table->text('flancer_work_experience')->nullable();
            $table->string('flancer_edu_quality')->nullable();
            $table->string('flancer_nickname')->nullable();
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
