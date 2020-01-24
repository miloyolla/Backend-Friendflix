<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Serie extends Model
{
    //relacionamento: usuario 1 - N series
    public function user(){
      return $this->belongsTo('App\User');
    }
}
