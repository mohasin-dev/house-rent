<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::all();
        return view('house', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required|unique:houses',
        ]);

        $house = new House();
        $house->name = $request->name;
        $house->address = $request->address;
        $house->area = $request->area;
        $house->save();
        Toastr::success('House Saved Successfully :)');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        $this->validate($request,[
            'name' => 'required|unique:houses,name,'.$request->id,
        ]);
        $houseUpdate = House::findOrFail($request->id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'area' => $request->area,
            ]);
        if($houseUpdate){
            Toastr::success('House Successfully Updated :)');
            return back();
        }else{
            Toastr::success('Something went wrong :(');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        $house->delete();
        Toastr::success('House Successfully Deleted :)');
        return back();
    }
}
