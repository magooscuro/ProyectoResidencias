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

Route::resource('dashboard/category', 'dashboard\CategoryController');
Route::resource('dashboard/user', 'dashboard\UserController');



Route::get('/detail/{id}', 'web\WebController@detail');
Route::get('/post-category/{id}', 'web\WebController@post_category');

Route::get('/contact', 'web\WebController@contact');

Auth::routes();

//---------------------------------------------------------------------------------
Route::get('/', 'web\WebController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home'); // <- por que tambien tnego una que va a home y a la raiz 


//Route::get('/', 'inicioController@index');//esta es de juandiego <- la usaras tu o yo ?
