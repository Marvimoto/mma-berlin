<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Gym;

class GymController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $gyms = Gym::all();
        return view('admin.gyms')
            ->with('gyms', $gyms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gym = new Gym;
        $gym->sure=0;
        return view('admin.creategym')
            ->with('gym', $gym);
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
            'ort' => 'required'
        );
        $this->validate($request, $rules);

        $gym = new Gym;
        $gym->name = $request->name;
        $gym->ort = $request->ort;
        if ($request->sure == 0){
            $oldgym = Gym::where('name', $request->name)->first();
            if ($oldgym != null){
                $request->sure = 1;
                return view('admin.creategym')
                    ->with('gym', $request);
            };
        }
        $gym->save();
        return Redirect::to('admin/gyms');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gym = Gym::find($id);
        return view('admin.editgym')
            ->with('gym', $gym);
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
        $gym = Gym::find($id);
        $gym->name = $request->name;
        $gym->ort = $request->ort;
        $gym->save();
        return Redirect::to('admin/gyms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gym = Gym::find($id);
        $gym->delete();
        return Redirect::to('admin/gyms');
    }
}
