<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    protected $table = 'fighter';

    public function gym(){
        return $this->belongsTo('App\Gym');
    }
}
