<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produto/listar',[ProdutoController::class, 'listar'])->name('produto.listar');

Route::get('/produto/cadastrar',[ProdutoController::class, 'create'])->name('produto.cadastro');

Route::post('/produto/salvar',[ProdutoController::class, 'add'])->name('produto.salvar');

Route::get('/produto/{id}/atualizar', [ProdutoController::class, 'atualizar'])->name('produto.atualizar');

Route::put('/produto/{id}/update', [ProdutoController::class, 'update'])->name('produto.update');

Route::delete('/produto/{id}', [ProdutoController::class, 'deletar'])->name('produto.deletar');


Route::get('/setor/cadastrar', function(){
    return view('cadastroSetor');
})->name('setor.cadastro');

Route::post('/setor/salvar',[SetorController::class, 'add'])->name('setor.salvar');

Route::get('/setor/listar',[SetorController::class, 'listarSetor'])->name('setor.listar');