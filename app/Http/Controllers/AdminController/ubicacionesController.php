<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ubicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(auth()->user()->rol->key == 'inventario'){
            return view('theme/admin/ubicaciones');
        }elseif(auth()->user()->rol->key == 'user') {
            return view('theme/user/ubicaciones');
        }
    }
}
