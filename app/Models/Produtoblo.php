<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtoblo extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function alunos(){
        return $this->belongsTo(Aluno::class,'id_aluno');
    }

    public function produtos(){
        return $this->belongsTo(Produto::class,'id_produto');
    }
}
