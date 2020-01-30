<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Serie extends Model
{
  public function users(){
    return $this->belongsToMany('App\User');
  }
}
