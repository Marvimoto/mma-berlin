<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Probetraining extends Model
{
    protected $table = 'probetraining';

    public function kurs(){
        return $this->belongsTo('App\Stundenplan');
    }
}
