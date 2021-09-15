<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loja', function (Blueprint $table) {

           //Table definitions
           $table->engine = 'InnoDB';
           $table->charset = 'utf8';
           $table->collation = 'utf8_unicode_ci';
           $table->comment = 'Tabela de lojas do usuario';

            $table->id();
            $table->text('nome');
            $table->text('endereco');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

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
        Schema::dropIfExists('loja');
    }
}
