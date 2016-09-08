<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $table='gym';

    public function fighter(){
        return $this->hasMany('App\Fighter');
    }
}
