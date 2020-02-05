<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use App\User;
use App\Serie;
use App\Http\Requests\UserRequest;
//use App\Http\Requests;
use App\Http\Resources\Users as UserResource;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  //Método responsável por criar novo usuário
  public function createUser(UserRequest $request){

    $user = new User;

    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->date_birth = $request->date_birth;
    $user->photo = $request->photo;
    $user->user_name = $request->user_name;
    $user->followers = $request->followers;
    $user->following = $request->following;
    $user->is_admin = $request->is_admin;
    $user->save();

    If (!Storage::exists('localUserPhotos/'))
			Storage::makeDirectory('localUserPhotos/',0775,true);

    $file = $request->file('photo');

    $filename = $user->id.'.'.$file->getClientOriginalExtension();
    $path = $file->storeAs('localUserPhotos', $filename);
    $user->photo = $path;

    $user->save();
    return response()->json([$user]);
  }

  //Método que retorna lista com todos os usuarios
  public function listUser(){

    $paginator = User::paginate(10);
    $user = UserResource::collection($paginator);
    $last = $paginator->lastPage();
    return response()->json([$user, $last]);
    //return response()->json(UserResource::collection($user));
  }

  //Método responsavel por exibir o usuario com o id informado
  public function showUser($id){
    $user = User::findOrFail($id); //findOrFail faz tratamento de erro
    //return response()->json([$user]);  //json formato de resposta
    return response()->json(new UserResource($user));
  }

  //Método para edição de dados do usuario
  public function updateUser(UserRequest $request, $id){
    $user = User::find($id);
    if($user){
      if($request->name){
        $user->name = $request->name;
      }
      if($request->photo){
        $user->photo = $request->photo;
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
    $user = User::findOrFail($id);

    Storage::delete($user->photo);
    User::destroy($id);
    return response()->json(['Usuario deletado']);
  }


// like

  //Método responsável por dar um like de um user para uma série
  public function followSerie($ser, $id){
    $user = User::find($id);
    $serie = Serie::find($ser);
    $user->series()->attach($serie->id);
    return response()->json(['Serie curtida']);
  }

  //Método responsável por tirar o like de um user para uma série
  public function unfollowSerie($ser, $id){
    $user = User::find($id);
    $serie = Serie::find($ser);
    $user->series()->detach($serie->id);
    return response()->json(['Curtida retirada']);
  }

  //Método responsável por listar as series curtidas de um user
    public function following($id){
      $user = User::find($id);
      return response()->json($user->series);
    }

    //Método responsável por exibir a foto do user
    public function exibir($id){
      $user = User::findOrFail($id);
      $path = $user->photo;
      return Storage::download($path);
    }


}
