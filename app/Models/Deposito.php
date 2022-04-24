<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_aluno',
        'dataD',
        'deposito',
        'saldo',
        'id_responsavel',
    ];

    public function alunos(){
        return $this->belongsTo(Aluno::class,'id_aluno');
    }
}
