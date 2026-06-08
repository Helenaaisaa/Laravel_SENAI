<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setores extends Model
{
    protected $table = "setores";

    protected $fillable = [
        'nome',
        'num_setor'
    ];

    public function produto(){
        return $this->hasMany(Produtos::class);
    }
}