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
            $table->string('line_img')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('career_id')->constrained('careers');
            $table->foreignId('specialty_id')->constrained('specialties');
            $table->string('license_number')->nullable();
            $table->string('email')->unique();
            $table->string('telephone')->unique()->nullable();
            $table->boolean('consented')->nullable();
            $table->string('agent')->nullable();
            $table->string('register_event')->nullable();
            $table->string('status')->default('pending');
            $table->string('event')->nullable();
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
