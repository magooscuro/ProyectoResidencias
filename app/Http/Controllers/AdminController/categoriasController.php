<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categoriasController extends Controller
{
    public function index()
    {
        return view('theme/admin/categorias');
        //
    }
}
