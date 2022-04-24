<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('preco');
            $table->string('tipo');
            $table->integer('qte');
            $table->string('imagem')->nullable();
            $table->string('ingredientes')->nullable();
            $table->string('fornecedor')->nullable();
            $table->integer('bloqueado')->nullable();
            $table->foreignId('id_cantina')
                  ->nullable()
                  ->constrained('cantinas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
