<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ubicacionesController extends Controller
{
    public function index()
    {
        return view('theme/admin/ubicaciones');
        //
    }
}
