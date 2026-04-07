<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalheProduto extends Model{

    protected $table = 'detalhesProduto';

    protected $fillable = [
        'descricao',
        'tamanho',
        'peso'
    ];

    public function produtos(){
        return $this->hasMany(Produto::class);
    }
}