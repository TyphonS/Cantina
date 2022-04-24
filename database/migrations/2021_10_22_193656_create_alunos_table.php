<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('turma');
            $table->string('turno');
            $table->string('nome');
            $table->string('tel');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('id_cantina')
                  ->nullable()
                  ->constrained('cantinas');
            $table->foreignId('id_responsavel')
                  ->nullable()
                  ->constrained('responsavels');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
