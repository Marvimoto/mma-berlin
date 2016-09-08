<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurs extends Model
{
    protected $table = 'kurs';

    public function stundenplan(){
        return $this->hasMany('App\Stundenplan');
    }
}
