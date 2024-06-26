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
        Schema::create('Members', function (Blueprint $table) {
            $table->id();
            $table->integer('nr')->unique()->nullable();
            $table->string('KNVvl')->unique()->nullable();
            $table->string('name')->unique();
            $table->string('first_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->integer('club_status')->nullable();
            $table->string('rdw_number')->unique()->nullable();
            $table->integer('instruct')->nullable();
            $table->integer('has_plane_brevet')->nullable();
            $table->integer('has_helicopter_brevet')->nullable();
            $table->integer('has_glider_brevet')->nullable();
            $table->integer('has_drone_a1')->nullable();
            $table->integer('has_drone_a2')->nullable();
            $table->integer('has_drone_a3')->nullable();            
            $table->integer('in_memoriam')->nullable();	
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Members');
    }
};
