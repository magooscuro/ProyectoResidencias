<?php

namespace App\Apimodelos;

use Illuminate\Database\Eloquent\Model;

class subcategorias extends Model
{
    protected $table='subcategorias';
    protected $fillable=['subcategoria','categoria_id'];

    public function categorias(){
        return $this->belongsTo('App\ApiModelos\categorias','categoria_id');
    }
}
