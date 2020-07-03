<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('dashboard/post', 'dashboard\PostController');
Route::post('dashboard/post/{post}/image', 'dashboard\PostController@image')->name('post.image');
Route::resource('dashboard/contact', 'dashboard\ContactController')->only([
    'index', 'show', 'destroy',
]);
Route::resource('dashboard/post-comment', 'dashboard\PostCommentController')->only([
    'index', 'show', 'destroy',]);

Route::post('dashboard/post/content_image', 'dashboard\PostController@contentImage');

Route::resource('dashboard/category', 'dashboard\CategoryController');
Route::resource('dashboard/user', 'dashboard\UserController');


Route::get('dashboard/post-comment/{post}/post', 'dashboard\PostCommentController@post')->name('post-comment.post');//ruta de los comentaros por post
Route::get('dashboard/post-comment/j-show/{postComment}', 'dashboard\PostCommentController@jshow');

Route::get('/detail/{id}', 'web\WebController@detail');
Route::get('/post-category/{id}', 'web\WebController@post_category');

Route::get('/contact', 'web\WebController@contact');

//login rutes

Auth::routes();



//---------------------------------------------------------------------------------
Route::get('/', 'web\WebController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home'); // <- por que tambien tnego una que va a home y a la raiz

Route::get('/admin','inicioController@index');
Route::get('/admin/productos','AdminController\productosController@index');
Route::get('/admin/categorias','AdminController\categoriasController@index');
Route::get('/admin/almacenes','AdminController\almacenesController@index');
Route::get('/admin/ubicaciones','AdminController\ubicacionesController@index');
Route::get('/admin/unidades','AdminController\unidadesController@index');



//Route::get('/', 'inicioController@index');//esta es de juandiego <- la usaras tu o yo ?
