<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;

class SerieController extends Controller
{
  //Método responsavel por criar uma nova série
  public function createSerie(Request $request){
    $serie = new Serie;

    $serie->name = $request->name;
    $serie->genre = $request->genre;
    $serie->synopsis = $request->synopsis;
    $serie->likes = $request->likes;
    $serie->seasons = $request->seasons;
    $serie->rating = $request->rating;
    $serie->save();

    return response()->json([$serie]);
  }

  //Método que retorna lista com todas as series
  public function listSerie(){
    $serie = Serie::all();
    return response()->json($serie);
  }

  //Método responsavel por exibir a serie com o id informado
  public function showSerie($id){
    $serie = Serie::findOrFail($id); //findOrFail faz tratamento de erro
    return response()->json([$serie]);  //json formato de resposta
  }

  //Método para edição de dados da serie
  public function updateSerie(Request $request, $id){
    $serie = Serie::find($id);

    if($serie){
      if($request->name){
        $serie->name = $request->name;
      }
      if($request->genre){
        $serie->genre = $request->genre;
      }
      if($request->synopsis){
          $serie->synopsis = $request->synopsis;
      }
      if($request->likes){
        $serie->likes = $request->likes;
      }
      
      if($request->seasons){
        $serie->seasons = $request->seasons;
      }
      if($request->rating){
        $serie->rating = $request->rating;
      }
      $serie->save();
      return response()->json([$serie]);
    }
    else{
      return response()->json(['Esta série não existe']);
    }
  }

  //Método usado para deletar uma serie
  public function deleteSerie($id){
    Serie::destroy($id);
    return response()->json(['Série deletada']);
  }
}
