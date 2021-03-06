<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->rol->key == 'inventario'){
            return view('theme/admin/productos');
        }elseif(auth()->user()->rol->key == 'user') {
            return view('theme/user/productos');
        }
        //
    }
}
