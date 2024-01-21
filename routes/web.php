<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login/{provider}', [LoginController::class,'redirectToProvider'])
->name('social.login');

Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])
->name('social.callback');
