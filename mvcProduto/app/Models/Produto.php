<?php
// Estou no arquivo Produto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Produto extends Model
{
    protected $fillable = [
        'nome',
        'quantidade',
        'valor',
        'setor_id'
    ];

    public function setor(){
        return $this->belongsTo(Setores::class);
    }

    public function detalhesProdutos(){
        return $this->hasOne(DetalheProdutos::class);
    }
}