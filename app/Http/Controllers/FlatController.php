<?php

namespace App\Http\Controllers;

use App\Flat;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use App\Floor;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $floors = Floor::all();
        $flats = Flat::all();
        return view('flat', compact('flats', 'floors'));
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
        //return $request->all();
        $this->validate($request, [
            'name' => 'required|unique:flats',
        ]);

        $flat = new Flat();
        $flat->name = $request->name;
        $flat->room_number = $request->room_number;
        $flat->area = $request->area;
        $flat->rent = $request->rent;
        $flat->electricity_bill = $request->electricity_bill;
        $flat->gass_bill = $request->gass_bill;
        $flat->water_bill = $request->water_bill;
        $flat->others_bill = $request->others_bill;
        $flat->floor_id = $request->floor_id;
        $flat->save();
        Toastr::success('Flat Saved Successfully :)');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(Flat $flat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    {
        //return $request->all();
        //dd();
        $this->validate($request,[
            'name' => 'required|unique:flats,name,'.$request->id,
        ]);
        $flatUpdate = Flat::findOrFail($request->id)->update([
            'name' => $request->name,
            'floor_id' => $request->floor_id,
            'area' => $request->area,
            'rent' => $request->rent,
            'room_number' => $request->room_number,
            'electricity_bill' => $request->electricity_bill,
            'gass_bill' => $request->gass_bill,
            'water_bill' => $request->water_bill,
            'others_bill' => $request->others_bill,
            ]);
        if($flatUpdate){
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
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        $flat->delete();
        Toastr::success('Flat Successfully Deleted :)');
        return back();
    }
}
