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
        Schema::create('work_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('work_profile_id');
            $table->string('flancer_id');
            $table->decimal('work_fee', 10, 2);
            $table->string('location')->nullable();
            $table->string('work_description')->unique();
            $table->index('work_description');
        
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_profile');
    }
};
