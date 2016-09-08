<?php

namespace App\Http\Controllers ;

use App\User;
use App\Stundenplan;
use App\Version;
use Auth;
use App\Http\Controllers\Controller;
use DB;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function stundenplanDashboard(){
        $date = date("Y-m-d");
        $user = Auth::user();
        $version = Version::where('valid_from','<', $date)->where('valid_until', '>', $date)->first();
        $stundenplan = Stundenplan::where('stundenplan_id', $version->id)->first();
        $kurscount = Stundenplan::where('stundenplan_id', $version->id)->count();
        return view('admin.stundenplandashboard', ['version' => $version, 'user' => $user, 'stundenplan' => $stundenplan, 'kurscount' => $kurscount]);
    }


    function logout(){
        Auth::logout();
    }

}
