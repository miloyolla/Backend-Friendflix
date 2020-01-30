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

Route::put('followSerie/{id}/{serie}', 'UserController@followSerie');
Route::put('unfollowSerie/{id}/{serie}', 'UserController@unfollowSerie');
Route::get('listFollowing/{id}', 'UserController@following');


//Rotas usadas para Serie
Route::get('listarSeries', 'SerieController@listSerie');
Route::get('mostrarSerie/{id}', 'SerieController@showSerie');
Route::post('criarSerie', 'SerieController@createSerie');
Route::put('atualizarSerie/{id}', 'SerieController@updateSerie');
Route::delete('deletarSerie/{id}', 'SerieController@deleteSerie');

Route::get('listFollowers/{id}', 'SerieController@followers');

//Rotas usadas para Comentario
Route::get('listarComentarios', 'CommentController@listComment');
Route::get('mostrarComentario/{id}', 'CommentController@showComment');
Route::post('criarComentario', 'CommentController@createComment');
Route::put('atualizarComentario/{id}', 'CommentController@updateComment');
Route::delete('deletarComentario/{id}', 'CommentController@deleteComment');

Route::put('relacionarUser/{id}', 'CommentController@addUser');
Route::put('removerRelacionamentoUser/{id}', 'CommentController@removeUser');
Route::get('listarCommentsUser/{id}', 'CommentController@listCommentUser');
Route::get('mostrarUserComment/{id}', 'CommentController@commentUser');

//Passport
Route::post('registrar', 'API\PassportController@register');
Route::post('login', 'API\PassportController@login');
Route::group(['middleware'=> 'auth:api'], function(){
  Route::post('logout', 'API\PassportController@logout');
  Route::get('getDetails', 'API\PassportController@getDetails');
});
