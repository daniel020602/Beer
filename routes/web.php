<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeerController;

Route::get('/',[BeerController::class,'index']);

Route::resource('beers',BeerController::class);