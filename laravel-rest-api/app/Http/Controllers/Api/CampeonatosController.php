<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CampeonatosResource;
use App\Models\Campeonato;
use App\Models\Jogo;
use App\Models\Participante;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampeonatosController extends Controller
{
    public function index()
    {
        $campeonatos = Campeonato::with(['participantes', 'jogos'])->get();
        return CampeonatosResource::collection($campeonatos);   
    }

    public function store(Request $request)
    {        

        try {
            
            DB::beginTransaction();

            $participantesRequest = $request->get('participantes'); 

            if (count($participantesRequest) <> 8) {
                return response()->json(
                    ['error' => "O campeonato deve ter 8 participantes"], 400                
                );
            }
            
            // 1: criar campeonato
            $campeonato = new Campeonato();
            $campeonato->nome = $request->get('campeonato_nome');
            $campeonato->save();           
                    
            // adicionar participantes ao campeonato                                             
            $participantes = [];

            foreach ($participantesRequest as $participante) {
                $participantes[] = new Participante($participante);
            }            

            $campeonato->participantes()->saveMany($participantes); 
                         
            Campeonato::gerar($campeonato);
        
            DB::commit();

            $campeonatos = Campeonato::with(['participantes', 'jogos'])->get();
            return response()->json(CampeonatosResource::collection($campeonatos), 201);

        } catch (\Throwable $th) {
            return response()->json(
                ['error' => $th->getMessage()], 400                
            );

            DB::rollBack();
        }      
    }
}