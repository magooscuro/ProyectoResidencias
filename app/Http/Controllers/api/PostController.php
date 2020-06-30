<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ModelosFormulario\Post;//se le agrega el modelo
use App\ModelosFormulario\Category;

class PostController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //listado
       //se hace la consulta de todos los post
        $posts = Post::
        join('post_images','post_images.post_id','=','posts.id')->
        join('categories','categories.id','=','posts.category_id')->//haciendo un join imagenes y post y muestre la imagen dependiendo del id coreespondiente con el post , ('talbas',comparativo,'columnas')
        select('posts.*','categories.title as category','post_images.image')->
        orderBy('posts.created_at', 'desc')->paginate(10); //se hace consulta de los elementos post que solo arroje ciertos campos cdesendentes y paguindaos
        
        return $this->successResponse($posts);
    }


    
    public function show(Post $post)//se agregan las variables donde esta lo que se quiere mostrar
    {
          //se hace la consulta de todos los post
         $post->image;
         $post->category;
          return $this->successResponse($post);
    }
 
    public function url_clean(String $url_clean)//se agregan las variables donde esta lo que se quiere mostrar
    {
      //funcion donde agrego la url unica para cada post 
       $post = Post::where('url_clean', $url_clean)->firstOrFail(); //consulta almacenada en la variable
             
          //se hace la consulta de todos los post
         $post->image;
         $post->category;
         return $this->successResponse($post);
    
      }
 


    public function category(Category $category)//se agregan las variables donde esta lo que se quiere mostrar
    {
       
          return $this->successResponse(["posts"=>$category->post()->paginate(10),"category"=>$category]);
    }//para que nos muestre los los post de cada categoria usando la espuesta succesrespons que es 200 y paginadas 
    //desde un arreglo puedo decirle a mi rest api que es lo que quiero que me arroje  

    

}
