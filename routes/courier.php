<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Courrier\ArriverController;

Route::get('arriver/{id}',[ArriverController::class,'show']);
