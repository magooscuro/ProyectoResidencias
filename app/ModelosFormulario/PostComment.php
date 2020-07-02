<?php

namespace App\ModelosFormulario;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = ["post_id", "title", "message", "user_id", "approved"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
