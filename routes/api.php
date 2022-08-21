<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\BoletoController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\DatosImpresionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/participantes', [ParticipanteController::class, 'index']);
Route::get('/datosimpresion', [DatosImpresionController::class, 'index']);
Route::get('/datosimpresion/{id}', [DatosImpresionController::class, 'show']);
Route::get('/habilitados', [BoletoController::class, 'index']);
Route::post('/insertardata', [TransaccionController::class, 'store']);
