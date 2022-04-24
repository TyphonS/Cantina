<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'produto_id',
        'nome',
        'qte',
        'preco',
        'dataP',
        'id_aluno',
    ];

    public function alunos(){
        return $this->belongsTo(Aluno::class,'id_aluno');
    }
}
