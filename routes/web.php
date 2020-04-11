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


Route::get('/', [
    'uses'=>'BlogController@index',
    'as'=>'blog'
]);

Route::get('/blog/{post}', [
    'uses'=> 'BlogController@show',
    'as' => 'blog.show'
]);


Route::get('/category/{category}', [
    'uses'=> 'BlogController@category',
    'as' => 'category'
]);

Route::get('/author/{author}', [
    'uses'=> 'BlogController@author',
    'as' => 'author'
]);



Auth::routes(['register' => false]);

//do disable registration

Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('/', 'Auth\LoginController@login')->name('login');

Route::resource('/backend/blog', 'Backend\BlogController');




