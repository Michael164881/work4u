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
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->integer('job_request_id')->unsigned();
            $table->integer('work_profile_id')->unsigned();
            $table->string('booking_status');
            $table->integer('notification_id')->unsigned()->nullable();
            $table->dateTime('booking_start_date')->nullable();
            $table->dateTime('booking_end_date')->nullable();
            $table->decimal('booking_fee', 10, 2)->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('booking');
    }
};
