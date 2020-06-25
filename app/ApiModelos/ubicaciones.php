<?php

namespace App\ApiModelos;

use Illuminate\Database\Eloquent\Model;

class ubicaciones extends Model
{
    protected $table = 'ubicaciones';
    protected $fillable = ['anaquel','nivel'];

    public function productos()
    {
        return $this->hasMany('App\ApiModelos\productos','ubicacion_id');
    }
}
