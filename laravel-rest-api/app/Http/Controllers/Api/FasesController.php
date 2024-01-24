<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fase;
use Illuminate\Http\Request;

class FasesController extends Controller
{
    public function index()
    {
        $fases = Fase::all();
        return response()->json(['fases' => $fases], 200);    
    }

    public function store(Request $request)
    {
        Fase::create($request->all());
        return response()->json('OK', 201);    
    }
}