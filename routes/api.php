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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->prefix('/v1')->namespace('Api\V1')->group(function () {
    Route::get('/movieUser','MovieUserController@index')->name('movieUser.index');
    Route::get('/filteredIndex','MovieUserController@filteredIndex')->name('movieUser.filteredIndex');
    Route::get('/movies','MovieController@index')->name('movies.index');
    Route::get('/categories','CategoryController@index')->name('categories.index');
    Route::get('/users','UserController@user')->name('users.user');

    Route::post('/movies','MovieController@store')->name('movies.store');
    Route::post('/movieUser','MovieUserController@store')->name('movieUser.store');

    Route::put('/movieUser/{movieUser}','MovieUserController@update')->name('movieUser.update');
    Route::put('/movies/{movie}','MovieController@update')->name('movies.update');

    Route::patch('/users/{user}','UserController@update')->name('users.update');

    Route::delete('/movieUser/{movieUser}','MovieUserController@delete')->name('movieUser.delete');
    Route::delete('/movies/{movie}','MovieController@delete')->name('movies.delete');
    Route::delete('/users/{user}','UserController@delete')->name('users.delete');
});

Route::prefix('/v1')->namespace('Api\V1')->group(function () {
    Route::get('/general','MovieUserController@generalIndex')->name('movieUser.generalIndex');
});
