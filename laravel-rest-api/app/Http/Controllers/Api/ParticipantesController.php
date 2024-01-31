<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use Illuminate\Http\Request;

class ParticipantesController extends Controller
{
    public function index(Campeonato $campeonato)
    {
        //$participantes = $campeonato->participantes()->get();

        dd($campeonato);

        //return response()->json($participantes, 200);
    }   
}
