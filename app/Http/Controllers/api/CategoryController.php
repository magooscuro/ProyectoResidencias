<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ModelosFormulario\Category;

class CategoryController extends ApiResponseController
{
    public function all()
    {
        return $this->successResponse(Category::all()); //obtiene todas las categorias 
    }
    
    public function index()
    {
        return $this->successResponse(Category::paginate(10)); //una categoria tiene muchos post
    }
}
