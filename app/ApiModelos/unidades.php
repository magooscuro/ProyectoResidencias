<?php

namespace App\ApiModelos;

use Illuminate\Database\Eloquent\Model;

class unidades extends Model
{
    protected $table = 'unidades';
    protected $fillable = ['unidad'];

    public function productos()
    {
        return $this->hasMany('App\ApiModelos\productos','unidad_id');
    }
}
