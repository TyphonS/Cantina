<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoblosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtoblos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_aluno')
                  ->nullable()
                  ->constrained('alunos')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->foreignId('id_produto')
                  ->nullable()
                  ->constrained('produtos')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->nullOnDelete();
            $table->string('statusblo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtoblos');
    }
}
