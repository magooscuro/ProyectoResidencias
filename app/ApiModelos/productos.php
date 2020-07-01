<?php

namespace App\ApiModelos;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    protected $table = 'productos';
    protected  $fillable = ['producto','almacen_id','subcategoria_id','ubicacion_id','unidad_id','cantidad'];

    public function almacenes()
    {
        return $this->belongsTo('App\ApiModelos\almacenes','almacen_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo('App\ApiModelos\subcategorias','subcategoria_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo('App\ApiModelos\ubicaciones','ubicacion_id');
    }

    public function unidad()
    {
        return $this->belongsTo('App\ApiModelos\unidades','unidad_id');
    }


}
