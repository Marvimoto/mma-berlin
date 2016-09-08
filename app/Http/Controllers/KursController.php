<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kurs;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class KursController extends Controller
{
    public function index()
    {
        $kurse = Kurs::all();

        return view('admin/kurse')
            ->with('kurse', $kurse);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin/createkurs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'name'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin/kurse/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $kurs = new Kurs;
            $kurs->name       = Input::get('name');
            $kurs->save();

            // redirect
            return Redirect::to('admin/kurse');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $kurs = Kurs::find($id);

        return view('admin/editkurs')
            ->with('kurs', $kurs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin.kurse/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $kurs = Kurs::find($id);
            $kurs->name       = Input::get('name');
            $kurs->save();

            // redirect
            return Redirect::to('admin/kurse');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $kurs = Kurs::find($id);
        $kurs->delete();

        return Redirect::to('admin/kurse');
    }
}
