<?php

use Illuminate\Http\Request;

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

Route::get('listarUsers', 'UserController@listUser'); //nome que quero dar - nome da controller@nome do método
Route::get('mostrarUser/{id}', 'UserController@showUser');
Route::post('criarUser', 'UserController@createUser');
Route::put('atualizarUser/{id}', 'UserController@updateUser');
Route::delete('deletarUser/{id}', 'UserController@deleteUser');
