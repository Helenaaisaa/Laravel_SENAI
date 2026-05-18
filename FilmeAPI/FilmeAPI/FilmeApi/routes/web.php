<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\AutorController;

Route::get('/', function () {
    return view('welcome');
});

// FILME

Route::get('/filme/listar', [FilmeController::class, 'listar']) -> name('filme.listar');



Route::get('/filme/cadastrar',[FilmeController::class, 'cadastro']
)->name('filme.cadastro');


Route::post('/filme/salvar', [FilmeController::class, 'add'])
->name('filme.salvar');


Route::get('/filme/{id}/atualizar', [FilmeController::class, 'atualizar'])
->name('filme.atualizar');

Route::put('/filme/{id}/update', [FilmeController::class, 'update'])
->name('filme.update');

Route::delete('/filme/{id}', [FilmeController::class, 'deletar'])
->name('filme.deletar');


// AUTOR

Route::get('/autor/cadastrar', function(){
    return view('cadastroAutor');
})->name('autor.cadastro');

Route::post('/autor/salvar', [AutorController::class, 'add'])
->name('autor.salvar');