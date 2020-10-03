<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->text('descricao');
            $table->integer('preco');
            $table->integer('lote');
            $table->integer('avaliacao');
            /*$table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');*/
            $table->foreignid('user_id')->onstrained();
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
        Schema::dropIfExists('products');
    }
}
