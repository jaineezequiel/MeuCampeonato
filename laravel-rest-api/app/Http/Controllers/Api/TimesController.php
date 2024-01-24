<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Http\Request;

class TimesController extends Controller
{
    public function index()
    {
        $times = Time::all();
        return response()->json(['times' => $times], 200);    
    }

    public function store(Request $request)
    {
        Time::create($request->all());
        return response()->json('OK', 201);    
    }
}