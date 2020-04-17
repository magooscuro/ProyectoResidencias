<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            
            $table->string('title',500)->nullable();

            $table->string('url_clean', 500)->nullable();

            
            $table->text('content')->nullable();
            
            
            $table->enum('posted', ['yes', 'not'])->default('not'); // si el post esta o no publicado (condicional si o no)

            
            $table->bigInteger('category_id')->nullable(); //categoria del post  
            
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
        Schema::dropIfExists('posts');
    }
}
