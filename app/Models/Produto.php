<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function cantinas(){
        return $this->belongsTo(Cantina::class,'id_cantina');
    }

    public function produtoblos(){
        return $this->hasMany(Produtoblo::class,'id');
    }
}
