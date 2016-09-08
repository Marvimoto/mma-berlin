<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $table = 'trainer';

    public function stundenplan(){
        return $this->hasMany('App\Stundenplan');
    }
}
