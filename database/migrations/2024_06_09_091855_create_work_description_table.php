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
        Schema::create('work_description', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('freelancer_id')->references('id')->on('freelancer_profile')->onDelete('cascade');
            $table->string('work_description_name');
            $table->text('work_description');
            $table->decimal('work_fee', 10, 2);
            $table->integer('work_period');
            $table->string('work_description_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_description');
    }
};
