<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
// ROTAS DE USUARIO

Route::get('/login', function(){
    return view('login');
})->name('login');

// rota para fazer o login
Route::post('/autenticar',[UserController::class, 'autenticar'])
->name('login.autenticar'); 

Route::get('/usuario/cadastrar', function(){
    return view('cadastroUsuario');
});
Route::post('/usuario/salvar',[UserController::class, 'add'])
->name('usuario.salvar');

// GET - listar os produtos cadastrados
Route::get('/produto/listar',[ProdutoController::class, 'listar'])->name('produto.listar');

Route::middleware('auth')->group(function () {

    Route::get('/produto/cadastrar',[ProdutoController::class, 'cadastro']
    )->name('produto.cadastro');

    // POST - enviar os dados para cadastrar usuários
    Route::post('/produto/salvar',[ProdutoController::class, 'add'])
    ->name('produto.salvar');

    // Tela de Atualizar
    Route::get('/produto/{id}/atualizar', [ProdutoController::class, 'atualizar'])
    ->name('produto.atualizar');

    Route::put('/produto/{id}/update',[ProdutoController::class, 'update'])
    ->name('produto.update');

    Route::delete('/produto/{id}',[ProdutoController::class, 'deletar'])
    ->name('produto.deletar');

    // ROTAS Dos Setores

    // GET - listar os setores cadastrados
    Route::get('/setor/listar',[SetorController::class, 'listar'])->
    name('setor.listar');

    Route::get('/setor/cadastrar', function(){ 
        return view('cadastroSetor');
    })->name('setor.cadastro');

    Route::post('/setor/salvar',[SetorController::class, 'add'])
    ->name('setor.salvar');

    // ROTA PARA SAIR 
    Route::post('/logout',[UserController::class, 'logout'])->name('logout')
});