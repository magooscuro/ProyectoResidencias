<?php

namespace App;

use App\ModelosFormulario\Rol; //agregando la funcion
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname','rol_id', 'email', 'password', // validando que solo se acepten esos campos se le anexaron apellido y rol_id
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //
     public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    //belongsto nos nos arroja el usuario que posee el rol
    public function es()
    {
        return $this->hasMany('App\ApiModelos\es');
    }
}
