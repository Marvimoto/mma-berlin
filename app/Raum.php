<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raum extends Model
{
    protected $table = 'raum';

    public function stundenplan(){
        return $this->hasMany('App\Stundenplan');
    }
}
