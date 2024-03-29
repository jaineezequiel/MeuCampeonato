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
            $table->foreignId('campeonato_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('time_casa_id');
            $table->unsignedBigInteger('time_fora_id');
            $table->integer('pontuacao_timecasa')->nullable();
            $table->integer('pontuacao_timefora')->nullable();    
            $table->timestamp('data_criacao')->current();

            $table->foreign('fase_id')->references('id')->on('fases');
            $table->foreign('time_casa_id')->references('id')->on('participantes');
            $table->foreign('time_fora_id')->references('id')->on('participantes');
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
