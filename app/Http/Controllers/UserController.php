<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  //Método responsável por criar novo usuário
    public function createUser(Request $request){
      $user = new User;

      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;
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
    public function updateUser(Request $request, $id){
      $user = User::find($id); //usa find para cair no ultimo else caso não exista

      if($user){
        if($request->name){
          $user->name = $request->name;
        }
        else if($request->email){
          $user->email = $request->email;
        }
        else if($request->password){
            $user->password = $request->password;
        }
        else{
          return response()->json(['insira o parâmetro a ser atualizado']);
        }
        $user->save();
        return response()->json([$user]);
      }
      else{
        return response()->json(['Este usuario não existe']);
      }
    }

    //Método usado para deletar um usuario
    public function deleteUser($id){
      User::destroy($id); //produra e deleta
      return response()->json(['Usuario deletado']);
    }
}
