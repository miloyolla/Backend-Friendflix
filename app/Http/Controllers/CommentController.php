<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\Serie;

class CommentController extends Controller
{
  //Método responsavel por criar um novo comentario
  public function createComment(Request $request){
    $comment = new Comment;

    $comment->text = $request->text;
    $comment->likes = $request->likes;
    $comment->share = $request->share;
    $comment->save();

    return response()->json([$comment]);
  }

  //Método que retorna lista com todos os comentarios
  public function listComment(){
    $comment = Comment::all();
    return response()->json($comment);
  }

  //Método responsavel por exibir o commentario com o id informado
  public function showComment($id){
    $comment = Comment::findOrFail($id);
    return response()->json([$comment]);
  }

  //Método para edição de dados do comentario
  public function updateComment(Request $request, $id){
    $comment = Comment::find($id);

    if($comment){
      if($request->text){
        $comment->text = $request->text;
      }
      if($request->likes){
        $comment->likes = $request->likes;
      }
      if($request->share){
          $comment->share = $request->share;
      }
      $comment->save();
      return response()->json([$comment]);
    }
    else{
      return response()->json(['Este comentario não existe']);
    }
  }

  //Método usado para deletar um comentario
  public function deleteComment($id){
    Comment::destroy($id);
    return response()->json(['Comentario deletada']);
  }

//USER

  //Método responsavel por estabelecer uma relação entre user e comentario
  public function addUser(Request $request, $id){
    $comment = Comment::find($id);
    if($request->user_id){
      $comment->user_id = $request->user_id;
    }
    $comment->save();
    return response()->json(['Sucesso']);
  }

  //Método responsavel por remover uma relação entre user e comentario
  public function removeUser($id){
    $comment = Comment::find($id);
    $comment->user_id = null;
    $comment->save();
    return response()->json(['Sucesso']);
  }

  //Método responsável por retrnar a qual user o comentário pertence
  public function commentUser($id){
    $comment = Comment::find($id);
    return response()->json($comment->user_id);
  }
  //Método responsável por listar os comentários do user
  public function listCommentUser($user_id){
    $user = User::find($user_id);
    return response()->json($user->comments);
  }
}
