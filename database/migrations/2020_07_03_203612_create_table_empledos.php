<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmpledos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empledos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nombres',200);
            $table->char('apellidos',200);
            $table->char('puesto',200);
            $table->char('telefono',200);
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
        Schema::dropIfExists('empledos');
    }
}
