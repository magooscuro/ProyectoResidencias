<?php

namespace App\ModelosFormulario;

use Illuminate\Database\Eloquent\Model;

use App\ModelosFormulario\Post;


class Category extends Model
{
    protected $fillable =['title','url_clean'];

 
 public function post()
        {
            return $this->hasMany(Post::class); //una categoria tiene muchos post
        }

}
