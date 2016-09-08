<?php

namespace App\Http\Controllers ;

use App\User;
use App\Version;
use App\Stundenplan;
use App\Kurs;
use App\Trainer;
use App\Raum;
use App\Tag;
use DateTime;
use App\Http\Controllers\Controller;


class ContentController extends Controller
{
    function infos() {
        return view('infos');
    }

    function preise() {
        return view('preise');
    }

    function training(){
        return view('training');
    }

    function team(){
        $trainers = Trainer::all();
        return view('team')
            ->with('trainers', $trainers);
    }

    function stundenplan(){
        $version = Version::where('valid_from', '<', date('Y-m-d'))->where('valid_until', '>', date('Y-m-d'))->first();
        $id = $version->id;
        $version->valid_from = new DateTime($version->valid_from);
        $version->valid_until = new DateTime($version->valid_until);
        $version->valid_from = date("d.m.Y", $version->valid_from->getTimestamp());
        $version->valid_until = date("d.m.Y", $version->valid_until->getTimestamp());
        $stundenplan = Stundenplan::with('kurs', 'tag', 'raum', 'trainer')->where('stundenplan_id', $id)->get()->sortBy('tag');
        $kurse = Kurs::all();
        $trainer = Trainer::all();
        $raeume = Raum::all();
        $tage = Tag::all();
        return view('stundenplan', ['version' => $version, 'stundenplan' => $stundenplan, 'tage' => $tage, 'kurse' => $kurse, 'trainer' => $trainer, 'raeume' => $raeume]);
    }
}
