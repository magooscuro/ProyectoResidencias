<?php

namespace App\ModelosFormulario;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable=['name','message','email','surname','phone'];
}
 