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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/generalUser', function () {
    return view('generalUser');
});

Auth::routes();//ルーティング追加するメソッド

Route::get('/home', 'HomeController@index')->name('home');


//// TODO::デバッグのとき使える方法
//Route::get('test', function () {
//    $movie = \App\Models\Movie::first();
//
//    dd($movie->user);
//});

