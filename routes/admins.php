<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\admins\AdminAdministrativeController;
use App\Http\Controllers\Auth\admins\AdminFinancieresController;
use App\Http\Controllers\Auth\admins\AdminTechniquesController;



//================ login administrative =================//

Route::get('/administrative', [AdminAdministrativeController::class, 'index']);
Route::post('/administrative/login', [AdminAdministrativeController::class, 'login'])->middleware('guest:sanctum');
Route::delete('/administrative/logout/{token?}',[AdminAdministrativeController::class,'logout']);
Route::post('/administrative/addImageProfile',[AdminAdministrativeController::class,'addImageProfile']);
Route::post('/administrative/editProfile',[AdminAdministrativeController::class,'editProfile']);

//================ login finenciere =================//

Route::get('/finenciere', [AdminFinancieresController::class, 'index']);
Route::post('/finenciere/login', [AdminFinancieresController::class, 'login'])->middleware('guest:sanctum');
Route::delete('/finenciere/logout/{token?}',[AdminFinancieresController::class,'logout']);
Route::post('/finenciere/addImageProfile',[AdminFinancieresController::class,'addImageProfile']);
Route::post('/finenciere/editProfile',[AdminFinancieresController::class,'editProfile']);
//================ login technique =================//

Route::get('/technique', [AdminTechniquesController::class, 'index']);
Route::post('/technique/login', [AdminTechniquesController::class, 'login'])->middleware('guest:sanctum');
Route::delete('/technique/logout/{token?}',[AdminTechniquesController::class,'logout']);
Route::post('/technique/addImageProfile',[AdminTechniquesController::class,'addImageProfile']);
Route::post('/technique/editProfile',[AdminTechniquesController::class,'editProfile']);


