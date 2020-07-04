<?php

namespace App\ApiModelos;

use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{
    //
    protected $table ="empledos";
    protected  $fillable = ["nombres","apellidos","puesto","telefono"];

    public function es()
    {
        return $this->hasMany('App\ApiModelos\es');
    }
}
