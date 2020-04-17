<?php

namespace App;
use App\Post;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{ 
    protected $fillable =['post_id','image'];   //para espesificar que queremos insertar y que no (lo agregamos a la bd)
      
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
