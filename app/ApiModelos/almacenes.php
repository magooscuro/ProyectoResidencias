<?php

namespace App\ApiModelos;

use Illuminate\Database\Eloquent\Model;

class almacenes extends Model
{
    protected $table = 'almacenes';
    protected  $fillable = ['almacen'];

    public function productos()
    {
        return $this->hasMany('App\ApiModelos\productos','almacen_id');
    }
}
