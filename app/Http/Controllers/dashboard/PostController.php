<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Support\Facades\URL;
use App\ModelosFormulario\PostImage;
use App\ModelosFormulario\Post; //modelo
use App\Http\Controllers\Controller; //controladores generales
use Illuminate\Http\Request; 
use App\Http\Requests\UpdatePostPut;
use App\Http\Requests\StorePostPost; //store
use App\ModelosFormulario\Category; //modelo 
use App\Helpers\CustomUrl;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     es lo pirmero que se moestrara index y con el arreglo se le pe agrega el parametro para despues consultarlo en otro lado */
     public function __construct()
    {
        $this->middleware(['auth','rol.admin']);
    }

   
     public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(); //cargando la variable de el metodo post de app
        
        return view("dashboard.post.index",['posts'=> $posts]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = Category::pluck('id','title');
        return view("dashboard.post.create",['post' => new Post(),'categories' => $categories]); //agrego la vista donde esta mi fomulario
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     //reques es para obtener los parametors desde el formulario
    public function store(StorePostPost $request)
    {
            //dd($request->validated());
           
           
         
            if($request->url_clean == ""){
                    $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->title),'-',true); //agregando el helper de validacion
            }else{
                $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->url_clean),'-',true); //agregando el helper de validacion
                
            } 
            $requestData = $request-> validated();// se clona el reques para inyectar valores ya que de manera direcno no lo permite 

             $requestData['url_clean'] = $urlClean;
             $validator = Validator::make($requestData,StorePostPost::myRules());

            if ($validator->fails()){ //lo tiene laravel por defecto el cual me iyecta en mi vista y formulario los errores de validacion que en este caso es si el url es unica o no 
                return redirect('dashboard/post/create')
                                ->withErrors($validator)
                                ->withInput();
            }
            
            
            //echo "Hola si se puedo Store: ".$urlClean;
            
          //dd($requestData); 
           Post::create($requestData); 
           
            return back()->with('status','Post Creado con Exito'); //para regresar al formulario y solo envia 
        }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        
       // $post = Post::findOrFail($id); // para mostrar los registos al usuario  de la variable ya cargada buscando una variable en espesifico que haga referencia a el contenido 
       // findorfail ecunetra el registo si existe y si no muestra que la paguina no existe en vez de arrojar error 
        return view ('dashboard.post.show',["post" => $post]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)

    {
        
        $categories = Category::pluck('id','title');
        
        return view ('dashboard.post.edit',['post' => $post,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostPut $request, Post $post)
    {
        //echo "Hola si se puedo update".$request -> title;
            
        $post -> update($request-> validated()); 
         //select * from post
         return back()->with('status','Post Actualizado con Exito'); //para regresar al formulario y solo envia
        
        
    }



    public function image(Request $request, Post $post)
    {
      
       $request->validate([
        'image' => 'required|mimes:jpeg,bmp,png|max:10240', //imagenes no mayores a 10 mb
       ]);

     $filename = time() . "." . $request->image->extension();
     
     $request->image->move(public_path('images'),$filename);
      
        PostImage::create(['image' => $filename,'post_id' => $post->id]);
        return back()->with('status','Imagen Cargada  con Exito'); //para regresar al formulario y solo envia
    }


    public function contentImage(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,bmp,png|max:10240', //10Mb
        ]);

        $filename = time() . "." . $request->image->extension();

        $request->image->move(public_path('images_post'), $filename); //si no existe la carpeta este metodo se ecarga de creaarla

        return response()->json(["default" => URL::to('/') . '/images_post/' . $filename]);

    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post ->delete();
        return back()-> with('status','Post Eliminado con Exito');
       
    }
}
