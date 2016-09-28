<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fighter;
use App\Gym;

use Illuminate\Support\Facades\Redirect;

class FighterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fighters = Fighter::with('gym')->get();
        return view('admin.fighters')
            ->with('fighters', $fighters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gyms = Gym::all()->sortBy('name');
        $gymarray = array();
        foreach ($gyms as $gym) {
            $gymarray[$gym->id] = $gym->name . ', ' . $gym->ort;
        }
        return view('admin.createfighter')
            ->with('gyms', $gymarray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'vorname' => 'required',
            'gym' => 'required'
        );
        $this->validate($request, $rules);

        $fighter = new Fighter;
        $fighter->vorname = $request->vorname;
        $fighter->name = $request->name;
        $fighter->gym_id = $request->gym;
        if ($request->file('photo')->isValid()) {
            $destinationPath = public_path('images/fighters'); // upload path
            $extension = $request->file('photo')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 999999) . '.' . $extension; // renaming image
            $request->file('photo')->move($destinationPath, $fileName); // uploading file to given path
            if ($fighter->photo != "") {
                unlink($destinationPath . "/" . $fighter->photo);
            }
            $fighter->photo = $fileName;
        }
        $fighter->save();
        return Redirect::to('admin/fighters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fighter = Fighter::find($id);
        //Gyms finden und sortieren
        $gyms = Gym::all()->sortBy('name');
        $gymarray = array();
        //In Form "Name, Ort" bringen
        foreach ($gyms as $gym) {
            $gymarray[$gym->id] = $gym->name . ', ' . $gym->ort;
        }
        return view('admin.editfighter')
            ->with('fighter', $fighter)
            ->with('gyms', $gymarray);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'vorname' => 'required',
            'gym' => 'required'
        );
        $this->validate($request, $rules);

        $fighter = Fighter::find($id);
        $fighter->vorname = $request->vorname;
        $fighter->name = $request->name;
        $fighter->gym_id = $request->gym;
        if ($request->file('photo')->isValid()) {
            $destinationPath = public_path('images/fighters'); // upload path
            $extension = $request->file('photo')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 999999) . '.' . $extension; // renaming image
            $request->file('photo')->move($destinationPath, $fileName); // uploading file to given path
            if ($fighter->photo != "") {
                unlink($destinationPath . "/" . $fighter->photo);
            }
            $fighter->photo = $fileName;
        }
        $fighter->save();
        return Redirect::to('admin/fighters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fighter = Fighter::find($id);
        $fighter->delete();
        return Redirect::to('admin/fighters');
    }
}
