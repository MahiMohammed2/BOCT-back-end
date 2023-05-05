<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Directory\PresidentController;

Route::get('/',[PresidentController::class,'index']);
Route::post('/addDirector',[PresidentController::class,'addDirector']);
Route::post('/editProfile',[PresidentController::class,'editProfile']);
Route::post('/addImageProfile',[PresidentController::class,'addImageProfile']);

Route::post('/login',[PresidentController::class,'login'])->middleware('guest:sanctum');
Route::delete('/logout/{token?}',[PresidentController::class,'logout']);

