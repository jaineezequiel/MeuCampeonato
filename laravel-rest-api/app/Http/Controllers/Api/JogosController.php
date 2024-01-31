<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use Illuminate\Http\Request;

class JogosController extends Controller
{
    public function index(Campeonato $campeonato)
    {
        return response()->json($campeonato->jogos, 200);
    }
}
