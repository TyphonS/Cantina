<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoDepositosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicodepositos', function (Blueprint $table) {
            $table->id();
            $table->date('dataD');
            $table->float('deposito');
            $table->float('saldo');
            $table->integer('id_responsavel');
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
        Schema::dropIfExists('historico_depositos');
    }
}
