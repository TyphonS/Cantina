<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoconsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicoconsumos', function (Blueprint $table) {
            $table->id();
            $table->integer('produto_id');
            $table->string('nome');
            $table->integer('qte');
            $table->float('preco');
            $table->date('dataP');
            $table->foreignId('id_aluno')
                  ->nullable()
                  ->constrained('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historicoconsumos');
    }
}
