<?php

namespace App\ApiModelos;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model{

    protected $table='categorias';
    protected $fillable=['categoria'];

    public function subcategorias(){
        return $this->hasMany('App\ApiModelos\subcategorias','categoria_id');
    }
}
