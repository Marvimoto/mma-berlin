<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

   public function stundenplan(){
       return $this->hasMany('App\Stundenplan');
   }
}