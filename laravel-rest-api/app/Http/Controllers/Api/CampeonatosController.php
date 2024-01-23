<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CampeonatosResource;
use App\Models\Campeonato;
use App\Models\Jogo;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampeonatosController extends Controller
{
    public function index()
    {
        $campeonatos = Campeonato::all();

        return CampeonatosResource::collection($campeonatos);   
    }

    public function store(Request $request)
    {        

        try {
            
           /* DB::beginTransaction();

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

            $campeonato->participantes()->saveMany($participantes);  */

            $campeonato = Campeonato::find('21');
                            
            // gerar jogos
            Jogo::gerar($campeonato);
        
            //DB::commit();

            return response()->json('OK', 200);

        } catch (\Throwable $th) {
            return response()->json(
                ['error' => $th->getMessage()], 400                
            );

            DB::rollBack();
        }      
    }
}