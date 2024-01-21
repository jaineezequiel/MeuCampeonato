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
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fase_id');
            $table->unsignedBigInteger('primeiro_time_id');
            $table->unsignedBigInteger('segundo_time_id');
            $table->integer('resultado_primeiro_time')->nullable();
            $table->integer('resultado_segundo_time')->nullable();    
            $table->timestamp('data_criacao');

            $table->foreign('fase_id')->references('id')->on('fases');
            $table->foreign('primeiro_time_id')->references('id')->on('participantes');
            $table->foreign('segundo_time_id')->references('id')->on('participantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};
