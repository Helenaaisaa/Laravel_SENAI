<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalhesProduto extends Model
{
    protected $table = 'detalhes_produto';

    protected $fillable = [
        'descricao',
        'tamanho',
        'peso',
        'produto_id'
    ];

    // Detalhe pertence a um produto
    public function produto(){
        return $this->belongsTo(Produto::class);
    }
}