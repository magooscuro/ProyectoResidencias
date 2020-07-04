<?php

namespace App\ApiModelos;

use Illuminate\Database\Eloquent\Model;

class es extends Model
{
    protected $table ="es";

    protected $fillable = ["autorizado_id","salida_id","cantidad","status","producto_id"];

    public function autoriza()
    {
        return $this->belongsTo('App\User','autorizado_id');
    }

    public function salida()
    {
        return $this->belongsTo('App\ApiModelos\empleado','salida_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\ApiModelos\productos');
    }
}
