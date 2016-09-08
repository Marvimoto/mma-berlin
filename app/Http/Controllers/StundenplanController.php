<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stundenplan;
use App\Version;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class StundenplanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stundenplaene = Stundenplan::all();

        return view('admin/stundenplaene')
            ->with('stundenplaene', $stundenplaene);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $rules = array();
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin/stundenplaene')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $stundenplan = new Stundenplan;
            $stundenplan->stundenplan_id = Input::get('stundenplan_id');
            $stundenplan->kurs_id = Input::get('kurs_id');
            $stundenplan->trainer_id = Input::get('trainer_id');
            $stundenplan->raum_id = Input::get('raum_id');
            $stundenplan->tag_id = Input::get('tag_id');
            $stundenplan->begins_at = Input::get('begins_at');
            $stundenplan->ends_at = Input::get('ends_at');
            $stundenplan->alter = Input::get('alter');
            $stundenplan->save();

            // redirect
            return Redirect::to('admin/stundenplaene/' . $stundenplan->stundenplan_id . "/edit");
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
        $version->valid_from = date('d.m.Y', strtotime($version->valid_from));
        $version->valid_until = date('d.m.Y', strtotime($version->valid_until));
        return view('admin/editversion')
            ->with('version', $version);
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
            return Redirect::to('admin.versionen/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $version = Version::find($id);
            $version->name = Input::get('name');
            $version->valid_from = Input::get('valid_from');
            $version->valid_until = Input::get('valid_until');
            $version->save();

            // redirect
            return Redirect::to('admin/versionen');
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
        $stundenplan = Stundenplan::find($id);
        $stundenplan->delete();

        return Redirect::to('admin/stundenplaene/' . $stundenplan->stundenplan_id . '/edit');
    }
}
