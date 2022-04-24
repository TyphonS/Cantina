<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCantinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cantinas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj');
            $table->string('name');
            $table->string('tel');
            $table->string('endereco');
            $table->string('email')->unique();
            $table->string('emailadm');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('sobrenos');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cantinas');
    }
}
