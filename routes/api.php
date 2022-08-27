<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\BoletoController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\DatosImpresionController;
use App\Http\Controllers\api\v2\BuscaBoletoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/participantes', [ParticipanteController::class, 'index']);

Route::get('/datosimpresion', [DatosImpresionController::class, 'index']);
Route::get('/datosimpresion/{id}', [DatosImpresionController::class, 'show']);

Route::get('/habilitados', [BoletoController::class, 'index']);

Route::post('/insertardata', [TransaccionController::class, 'store']);

Route::get('/buscaboletos', [BuscaBoletoController::class, 'index']);
Route::get('/buscaboletos/{numero}', [BuscaBoletoController::class, 'show']);
Route::put('/buscaboletos/{numero}', [BuscaBoletoController::class, 'update']);
