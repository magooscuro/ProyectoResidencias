<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\PostImage;

class Post extends Model
{
        protected $fillable =['title','url_clean','category_id','posted','content'];   //para espesificar que queremos insertar y que no (lo agregamos a la bd)
      
        public function category()
        {
            return $this->belongsTo(Category::class);
        }

        public function image()
        {
            return $this->hasOne(PostImage::class);
        }
}
