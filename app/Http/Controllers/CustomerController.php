<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Image;
use File;
use Auth;


class CustomerController extends Controller
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
        $customers = Customer::all();
        return view('customer', compact('customers'));
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
            'name' => 'required',
        ]);

        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(250, 300)->save($location);
        }else{
            $filename = 'customer.png';
        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->nid = $request->nid;
        $customer->advanced = $request->advanced;
        $customer->note = $request->note;
        $customer->added_by = Auth::id();
        $customer->image = $filename;
        $customer->save();
        Toastr::success('customer Saved Successfully :)');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('image')) {
            if(File::exists('images/'.$customer->image)){
                File::delete('images/'.$customer->image);
               }
            $image = $request->file('image');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(250, 300)->save($location);
            $customer->image = $filename;
        }
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->nid = $request->nid;
        $customer->advanced = $request->advanced;
        $customer->note = $request->note;
        $customer->added_by = Auth::id();
        $customer->save();
        Toastr::success('customer Updated Successfully :)');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        Toastr::success('Customer Successfully Deleted :)');
        return back();
    }
}
