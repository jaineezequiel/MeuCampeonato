<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class Campeonatos extends Controller
{
    public function index()
    {
        $campeonatos = Campeonato::all();

        return View('historico', compact('campeonatos'));
    }

    public function create()
    {

        return View('create');
    }

    public function store()
    {

        try {

            //validações

            DB::beginTransaction();

            //  criar campeonato


            // fazer inscricao dos times


            // gerar jogos / Chamada phyton


            // salvar pontuacoes e marcar eliminados

            // salvar hanking de campeoes

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
        }

       return to_route('campeonatos.historico');
    }
}