<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CampeonatosController;
use App\Http\Controllers\Api\FasesController;
use App\Http\Controllers\Api\JogosController;
use App\Http\Controllers\Api\ParticipantesController;
use App\Http\Controllers\Api\TimesController;
use Illuminate\Support\Facades\Route;

Route::get('auth/{provider}', [AuthController::class, 'redirectToProvider'])->name('auth');

Route::get('auth/{provider}/callback', [AuthController::class, 'handleProviderCallback'])
->name('auth.callback');

Route::group(['prefix' =>  'v1'], function(){
    Route::apiResource('campeonatos', CampeonatosController::class)
    ->except(['update', 'destroy']);

    Route::apiResource('times', TimesController::class)
    ->only(['index', 'store']);

    Route::apiResource('fases', FasesController::class)
    ->only(['index', 'store']);

    Route::get('campeonatos/{campeonatos}/jogos', [JogosController::class, 'index']);
    Route::get('campeonatos/{campeonatos}/participantes', [ParticipantesController::class, 'index']);
});