<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Directory\DirectorController;

Route::post('/login',[DirectorController::class,'login'])->middleware('guest:sanctum');
Route::delete('/logout/{token?}',[DirectorController::class,'logout']);

Route::get('/',[DirectorController::class,'index']);
Route::post('/editProfile',[DirectorController::class,'editProfile']);

Route::post('/addSuperAdmin',[DirectorController::class,'addSuperAdmin']);
Route::post('/editSuperAdmin/{id}',[DirectorController::class,'editSuperAdmin']);
Route::delete('/deleteSuperAdmin/{id}',[DirectorController::class,'deleteSuperAdmin']);

Route::post('/addImageProfile',[DirectorController::class,'addImageProfile']);
