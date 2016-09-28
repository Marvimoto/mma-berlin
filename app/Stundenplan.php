<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stundenplan extends Model
{
    protected $table = 'kursplan';

    public function raum(){
        return $this->belongsTo('App\Raum');
    }

    public function kurs(){
        return $this->belongsTo('App\Kurs');
    }

    public function tag(){
        return $this->belongsTo('App\Tag');
    }

    public function trainer(){
        return $this->belongsTo('App\Trainer');
    }

    public function probetraining(){
        return $this->hasMany('App\Probetraining');
    }
}
