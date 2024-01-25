<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
use App\Flat;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $start = new Carbon('first day of last month');
       // $end = new Carbon('last day of last month');
        $start = Carbon::now()->startOfMonth()->toDateString();
        $end = Carbon::now()->endOfMonth()->toDateString();

        // $from = date('2019-06-01');
        // $to = date('2019-06-30');

        $bills = Bill::whereBetween('created_at', [$start, $end])->get();
        //$bills = Bill::all();
        $customers = Customer::all();
        $flats = Flat::all();
        return view('bill', compact('bills', 'customers', 'flats'));
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
        //return $request->all();
        $this->validate($request, [
            'user_id' => 'required',
            'flat_id' => 'required',
            'amount' => 'required',
            'month' => 'required',
            'date' => 'required',
        ]);

        $bill = new Bill();
        $bill->user_id = $request->user_id;
        $bill->flat_id = $request->flat_id;
        $bill->amount = $request->amount;
        $bill->month = $request->month;
        $bill->date = $request->date;
        $bill->save();
        Toastr::success('Bill Successfully Taken :)');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
