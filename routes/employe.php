<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\employe\EmployeController;



Route::post('login',[EmployeController::class,'login'])->middleware('guest:sanctum');
Route::delete('/logout/{token?}',[EmployeController::class,'logout']);


Route::get('/',[EmployeController::class, 'index']);
Route::post('/addArriver',[EmployeController::class, 'addArriver']);
Route::post('/addDepart',[EmployeController::class, 'addDepart']);

Route::delete('/deleteArriver/{id}',[EmployeController::class, 'deleteArriver']);
Route::delete('/deleteDepart/{id}',[EmployeController::class, 'deleteDepart']);

Route::post('/addImageProfile',[EmployeController::class,'addImageProfile']);
Route::post('editProfile',[EmployeController::class, 'editProfile']);
