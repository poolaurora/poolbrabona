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
        Schema::create('mining_rooms', function (Blueprint $table) {
            $table->id();
            // Altera total_power para ser um campo integer
            $table->bigInteger('total_power')->default(0);
            $table->integer('capacity');
            $table->text('role_allowed')->nullable();
        
            // Adiciona owner_id como uma foreign key para users
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        
            // Coluna end_date para registrar a data de fim da sala
            $table->dateTime('end_date')->nullable();
        
            $table->timestamps();
        });
             
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mining_rooms');
    }
};
