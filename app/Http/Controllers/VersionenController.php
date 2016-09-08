<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Version;
use App\Stundenplan;
use App\Kurs;
use App\Trainer;
use App\Raum;
use App\Tag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DateTime;

use App\Http\Requests;

class VersionenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $versionen = Version::all();
        $versionen = $versionen->sortBy("valid_from");

        return view('admin.stundenplaene')
            ->with('versionen', $versionen);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.createversion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $rules = array(
            'name' => 'required',
            'valid_from' => 'required',
            'valid_until' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin/stundenplaene/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $version = new Version;
            $version->name = Input::get('name');
            $version->valid_from = date("Y-m-d", strtotime(Input::get('valid_from')));
            $version->valid_until = date("Y-m-d", strtotime(Input::get('valid_until')));
            $version->save();

            // redirect
            return Redirect::to('admin/stundenplaene');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $version = Version::find($id);
        $version->valid_from = new DateTime($version->valid_from);
        $version->valid_until = new DateTime($version->valid_until);
        $version->valid_from = date("d.m.Y", $version->valid_from->getTimestamp());
        $version->valid_until = date("d.m.Y", $version->valid_until->getTimestamp());
        $stundenplan = Stundenplan::with('kurs', 'tag', 'raum', 'trainer')->where('stundenplan_id', $id)->get()->sortBy('tag');
        $kurse = Kurs::all();
        $trainer = Trainer::all();
        $raeume = Raum::all();
        $tage = Tag::all();
        return view('admin.editstundenplan', ['version' => $version, 'stundenplan' => $stundenplan, 'tage' => $tage, 'kurse' => $kurse, 'trainer' => $trainer, 'raeume' => $raeume]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'name' => 'required',
            'valid_from' => 'required',
            'valid_until' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin.stundenplaene/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $version = Version::find($id);
            $version->name = Input::get('name');
            $version->valid_from = date("Y-m-d", strtotime(Input::get('valid_from')));
            $version->valid_until = date("Y-m-d", strtotime(Input::get('valid_until')));
            $version->save();

            // redirect
            return Redirect::to('admin/stundenplaene');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $version = Version::find($id);
        $version->delete();

        return Redirect::to('admin/stundenplaene');
    }
}
