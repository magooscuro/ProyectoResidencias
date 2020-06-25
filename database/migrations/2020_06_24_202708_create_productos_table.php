<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('producto');
            $table->bigInteger('almacen_id')->unsigned();
            $table->foreign('almacen_id')->references('id')->on('almacenes');
            $table->bigInteger('subcategoria_id')->unsigned();
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias');
            $table->bigInteger('ubicacion_id')->unsigned();
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');
            $table->bigInteger('unidad_id')->unsigned();
            $table->foreign('unidad_id')->references('id')->on('unidades');
            $table->Integer('cantidad');

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
        Schema::dropIfExists('productos');
    }
}
