<?php

namespace App\Http\Controllers;

use App\Floor;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\House;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::all();
        $floors = Floor::all();
        return view('floor', compact('floors', 'houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request->all();
       // dd();
        $this->validate($request, [
            'name' => 'required|unique:floors',
        ]);

        $floor = new Floor();
        $floor->name = $request->name;
        $floor->flat_number = $request->flat_number;
        $floor->area = $request->area;
        $floor->house_id = $request->house_id;
        $floor->save();
        Toastr::success('Floor Saved Successfully :)');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Floor $floor)
    {
        $this->validate($request,[
            'name' => 'required|unique:houses,name,'.$request->id,
        ]);
        $floorUpdate = Floor::findOrFail($request->id)->update([
            'name' => $request->name,
            'house_id' => $request->house_id,
            'area' => $request->area,
            'flat_number' => $request->flat_number,
            ]);
        if($floorUpdate){
            Toastr::success('Floor Successfully Updated :)');
            return back();
        }else{
            Toastr::success('Something went wrong :(');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor)
    {
        $floor->delete();
        Toastr::success('Floor Successfully Deleted :)');
        return back();
    }
}
