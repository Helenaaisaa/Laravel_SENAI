<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aluno/listar',[AlunoController::class,'listar'])->name('aluno.listar');

route::get('/aluno/cadastrar', function(){
    return view('cadastro');
})->name('aluno.cadastro');

//POST - enviar os dados para cadastrar usuários
Route::post('/aluno/salvar',[AlunoController::class, 'add'])
->name('aluno.salvar');

//Tela de atualizar
Route::get('/aluno/{id}/atualizar', [AlunoController::class, 'atualizar']) ->name('aluno.atualizar');

Route::put('/aluno/{id}/update', [AlunoController::class, 'update'])->name('aluno.update');

