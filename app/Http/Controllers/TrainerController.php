<?php

namespace App\Http\Controllers ;

use App\User;
use App\Http\Controllers\Controller;
use App\Trainer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class TrainerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trainers = Trainer::all();

        return view('admin/trainer')
            ->with('trainers', $trainers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin/createtrainer');
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
            return Redirect::to('admin/trainer/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $trainer = new Trainer;
            $trainer->name      = Input::get('name');
            $trainer->teaches   = Input::get('teaches');
            $trainer->career    = Input::get('career');
            $trainer->job       = Input::get('job');
            $trainer->trainer_since = Input::get('trainer_since');
            $trainer->languages = Input::get('languages');
            $trainer->fav_technique = Input::get('fav_technique');
            $trainer->misc      = Input::get('misc');
            $trainer->links     = Input::get('links');
            $trainer->save();

            // redirect
            return Redirect::to('admin/trainer');
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
        $trainer = Trainer::find($id);

        return view('admin/edittrainer')
            ->with('trainer', $trainer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin.trainer/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $trainer = Trainer::find($id);
            $trainer->name       = Input::get('name');
            $trainer->teaches   = Input::get('teaches');
            $trainer->career    = Input::get('career');
            $trainer->job       = Input::get('job');
            $trainer->trainer_since = Input::get('trainer_since');
            $trainer->languages = Input::get('languages');
            $trainer->fav_technique = Input::get('fav_technique');
            $trainer->misc      = Input::get('misc');
            $trainer->links     = Input::get('links');
            if ($request->file('photo')->isValid()) {
                $destinationPath = public_path('images'); // upload path
                $extension = $request->file('photo')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renaming image
                $request->file('photo')->move($destinationPath, $fileName); // uploading file to given path
                if($trainer->photo != "") {
                    unlink($destinationPath . "/" . $trainer->photo);
                }
                $trainer->photo = $fileName;
            }
            $trainer->save();

            // redirect
            return Redirect::to('admin/trainer');
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
        $trainer = Trainer::find($id);
        $trainer->delete();

        return Redirect::to('admin/trainer');
    }
}