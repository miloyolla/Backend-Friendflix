<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
  //Método responsável por criar novo usuário
  public function createUser(UserRequest $request){

    $user = new User;

    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->date_birth = $request->date_birth;
    $user->user_name = $request->user_name;
    $user->followers = $request->followers;
    $user->following = $request->following;
    $user->save();

    return response()->json([$user]);
  }

  //Método que retorna lista com todos os usuarios
  public function listUser(){
    $user = User::all();
    return response()->json($user);
  }

  //Método responsavel por exibir o usuario com o id informado
  public function showUser($id){
    $user = User::findOrFail($id); //findOrFail faz tratamento de erro
    return response()->json([$user]);  //json formato de resposta
  }

  //Método para edição de dados do usuario
  public function updateUser(UserRequest $request, $id){
    $user = User::find($id);
    if($user){
      if($request->name){
        $user->name = $request->name;
      }
      if($request->email){
        $user->email = $request->email;
      }
      if($request->password){
        $user->password = $request->password;
      }
      if($request->date_birth){
        $user->date_birth = $request->date_birth;
      }
      if($request->user_name){
        $user->user_name = $request->user_name;
      }
      if($request->followers){
        $user->followers = $request->followers;
      }
      if($request->following){
        $user->following = $request->following;
      }
      $user->save();
      return response()->json([$user]);
    }
    else{
      return response()->json(['Este usuario nao existe']);
    }
  }

  //Método usado para deletar um usuario
  public function deleteUser($id){
    User::destroy($id);
    return response()->json(['Usuario deletado']);
  }
}
