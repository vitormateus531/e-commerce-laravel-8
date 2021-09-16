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

            //Table definitions
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->comment = 'Tabela de produtos da loja';

            $table->id();
            $table->text('imagem');
            $table->text('nome');
            $table->text('codigo');
            $table->double('valor', 8, 2);

            $table->unsignedBigInteger('id_loja');
            $table->foreign('id_loja')->references('id')->on('loja');

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
        Schema::dropIfExists('produtos');
    }
}
