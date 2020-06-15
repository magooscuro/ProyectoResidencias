	<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('categorias','ApiControllers\categoriasController');

Route::resource('subcategorias','ApiControllers\subCategoriaController');
Route::resource('ubicaciones','ApiControllers\ubicacionesController');
Route::resource('almacenes','ApiControllers\almacenesController');
Route::resource('unidades','ApiControllers\unidadesController');




Route::resource('post', 'api\PostController')->only(['index','show']);//para que solo muestre esas dos rutas que quiero usar

Route::get('post/{category}/category','api\PostController@category');//para que solo muestre esas dos rutas que quiero usar
Route::get('category','api\CategoryController@index');//para que solo muestre esas dos rutas que quiero usar
Route::get('category/all','api\CategoryController@all');
Route::get('post/{url_clean}/url_clean','api\PostController@url_clean');// ruta de url_clen de postcontroller
