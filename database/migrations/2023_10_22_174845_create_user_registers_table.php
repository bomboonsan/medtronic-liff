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
        Schema::create('user_registers', function (Blueprint $table) {
            $table->id();
            $table->string('line_token');
            $table->string('line_img');
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('career_id')->constrained('careers');
            $table->foreignId('specialty_id')->constrained('specialties');
            $table->string('license_number');
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->boolean('consented');
            $table->string('agent');
            $table->string('event');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_registers');
    }
};
