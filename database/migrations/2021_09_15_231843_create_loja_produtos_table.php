<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loja_produtos', function (Blueprint $table) {
            
            //Table definitions
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->comment = 'Tabela Associativa de lojas e produtos';
            
            // Column Definitions
            $table->unsignedBigInteger('loja_id');
            $table->foreign('loja_id')->references('id')->on('loja');
            $table->unsignedBigInteger('produtos_id');
            $table->foreign('produtos_id')->references('id')->on('produtos');
            $table->timestamps();

            // Primary Key Definition
            $table->primary(['loja_id', 'produtos_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loja_produtos');
    }
}
