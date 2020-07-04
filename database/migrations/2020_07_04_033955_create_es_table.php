<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('autorizado_id')->unsigned();
            $table->foreign('autorizado_id')->references('id')->on('users');
            $table->bigInteger('salida_id')->unsigned();
            $table->foreign('salida_id')->references('id')->on('empledos');
            $table->bigInteger('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->integer("cantidad");
            $table->boolean('status');
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
        Schema::dropIfExists('es');
    }
}
