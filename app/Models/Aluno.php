<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Aluno extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'turma',
        'turno',
        'nome',
        'tel',
        'email',
        'password',
        'id_responsavel',
        'id_cantina',
        'status',
        'saldo',
    ];

    public function cantinas(){
        return $this->belongsTo(Cantina::class,'id_cantina');
    }

    public function responsavels(){
        return $this->belongsTo(Responsavel::class,'id_responsavel');
    }

    public function produtoblos(){
        return $this->hasMany(Produtoblo::class,'id');
    }

    public function historicoconsumos(){
        return $this->hasMany(HistoricoConsumo::class,'id');
    }

    public function consumos(){
        return $this->hasMany(Consumo::class,'id');
    }

    public function historicodepositos(){
        return $this->hasMany(HistoricoDeposito::class,'id');
    }
}
