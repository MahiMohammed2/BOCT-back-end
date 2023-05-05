<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Courrier\ArriverController;
use App\Http\Controllers\Courrier\DepartController;

/*
|--------------------------------------------------------------------------
| Get data of tables :
|   => arriver
|   => depart
|--------------------------------------------------------------------------
*/

Route::get('arriver/{id}',[ArriverController::class,'show'])->middleware('guest:sanctum');

Route::get('depart/{id}',[DepartController::class,'show']);
