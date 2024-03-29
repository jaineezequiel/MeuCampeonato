<?php

use App\Models\Campeonato;
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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campeonato_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('time_id');
            $table->integer('pontuacao')->default(0);
            $table->enum('eliminado' , [0, 1])->default(0);
            $table->integer('classificacao')->nullable();
            $table->timestamp('data_inscricao')->current();

            $table->foreign('time_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
