<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Campeonatos;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('login/{provider}', [LoginController::class,'redirectToProvider'])
->name('social.login');

Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])
->name('social.callback');

Route::controller(Campeonatos::class)->group(function(){
    Route::get('/', 'create')->name('campeonatos.create');
    Route::get('/home', 'create')->name('campeonatos.create');
    
    Route::get('/campeonatos', 'index')->name('campeonatos.historico');

    Route::get('/campeonatos/criar', 'create')->name('campeonatos.create');
    Route::post('/campeonatos', 'store')->name('campeonatos.store');
});
