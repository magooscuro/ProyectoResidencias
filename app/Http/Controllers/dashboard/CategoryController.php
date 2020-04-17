<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Requests\StoreCategoryPost;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CategoryController extends Controller
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
        $categories = Category::orderBy('created_at', 'desc')->paginate(); //cargando la variable de el metodo post de app
        
        return view("dashboard.category.index",['categories'=> $categories]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.category.create",['category' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryPost $request)
    {
        echo "Hola si se puedo Store".$request -> title;
            
        Category::create($request-> validated()); 
         //select * from post
         return back()->with('status','Category Creado con Exito'); //para regresar al formulario y solo envia 
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view ('dashboard.category.show',["category" => $category]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view ('dashboard.category.edit',["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryPost $request, Category $category)
    {
        echo "Hola si se puedo update".$request -> title;
            
        $category -> update($request-> validated()); 
         //select * from post
         return back()->with('status','Categoria Actualizado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category ->delete();
        return back()-> with('status','categoria Eliminado con Exito');
    }
}
