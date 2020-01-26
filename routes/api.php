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

//Rotas usadas para User
Route::get('listarUsers', 'UserController@listUser');
Route::get('mostrarUser/{id}', 'UserController@showUser');
Route::post('criarUser', 'UserController@createUser');
Route::put('atualizarUser/{id}', 'UserController@updateUser');
Route::delete('deletarUser/{id}', 'UserController@deleteUser');

//Rotas usadas para Serie
Route::get('listarSeries', 'SerieController@listSerie');
Route::get('mostrarSerie/{id}', 'SerieController@showSerie');
Route::post('criarSerie', 'SerieController@createSerie');
Route::put('atualizarSerie/{id}', 'SerieController@updateSerie');
Route::delete('deletarSerie/{id}', 'SerieController@deleteSerie');

//Rotas usadas para Comentario
Route::get('listarComentarios', 'CommentController@listComment');
Route::get('mostrarComentario/{id}', 'CommentController@showComment');
Route::post('criarComentario', 'CommentController@createComment');
Route::put('atualizarComentario/{id}', 'CommentController@updateComment');
Route::delete('deletarComentario/{id}', 'CommentController@deleteComment');
Route::put('relacionar/{id}', 'CommentController@addUser');
Route::put('removerRelacionamento/{id}', 'CommentController@removeUser');
