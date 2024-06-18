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
            $table->integer('work_description_id');
            $table->string('work_description')->unique();
            $table->index('work_description');
            $table->string('work_period')->nullable();
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
