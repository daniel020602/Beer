<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeerController;
use Illuminate\Support\Facades\Auth;
Route::get('/',function(){return view('welcome');});

Route::resource('beers',BeerController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
