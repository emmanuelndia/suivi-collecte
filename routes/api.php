<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonneCollecteController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::post('user/create', [AuthController::class, 'store']);
Route::post('personnecollecte/create', [PersonneCollecteController::class, 'store']);

Route::get('personnecollecte/index', [PersonneCollecteController::class, 'index']);
