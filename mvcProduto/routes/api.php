<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetorApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// estou no api.php
// rotas para a api de sensores
Route::get('setores',[SetorApiController::class, 'listarApi']);
Route::post('setor/add',[SetorApiController::class, 'addApi']);
Route::put('setor/atualizar/{id}',[SetorApiController::class, 'updateApi']);
Route::delete('setor/deletar/{id}',[SetorApiController::class, 'deletarApi']);