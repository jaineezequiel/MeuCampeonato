<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampeonatoRequest;
use App\Models\Campeonato;
use App\Models\Participante;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class CampeonatosController extends Controller
{
    public function index()
    {
        $campeonatos = Campeonato::all();
        return response()->json('campeonatos');    
    }

    public function store(CampeonatoRequest $request)
    {

        try {
            
            DB::beginTransaction();

            // 1: criar campeonato
            $campeonato = new Campeonato();
            $campeonato->nome = $request->get('campeonato_nome');
            $campeonato->save();

            // adicionar participantes ao campeonato
            $participantesRequest = $request->get('participantes');

            $participantes = [];

            foreach ($participantesRequest as $participante) {
                $participantes[] = new Participante($participante);
            }            

            $campeonato->participantes()->saveMany($participantes);
        
            // gerar jogos / Chamada phyton


            // salvar pontuacoes e marcar eliminados

            // salvar hanking de campeoes

            DB::commit();

        } catch (\Throwable $th) {
            return response()->json(
                ['error' => $th->getMessage()], 400                
            );;

            DB::rollBack();
        }
      
    }
}