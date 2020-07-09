<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserPost;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserPut;

class UserController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','rol.admin']);
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(); //cargando la variable de el metodo post de app
        
        return view("dashboard.user.index",['users'=> $users]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.user.create",['user' => new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        echo "Hola si se puedo Store".$request -> title;
            
        User::create(
            [
                'name' => $request['name'],
                'rol_id' => 4, //con el 1 se crea un usuario administrador 
                'surname' => $request['surname'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]
        ); 
         //select * from post
         return back()->with('status','Usuario Creado con Exito'); //para regresar al formulario y solo envia 
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view ('dashboard.user.show',["user" => $user]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view ('dashboard.user.edit',["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPut $request, User $user)
    {
        //echo $request -> route('user')->id;
            
        $user -> update(
            [
                'name' => $request['name'],
                'surname' => $request['surname'],
                'email' => $request['email'],
		'password' => Hash::make($request['password']),
                
            ]
        ); 
         //select * from post
         return back()->with('status','Usuario Actualizado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user ->delete();
        return back()-> with('status','Usuario eliminado Eliminado con Exito');
    }
}
