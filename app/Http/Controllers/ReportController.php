<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
use App\Flat;
use App\Bill;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('monthlyReport');
    }
    public function monthlyReport(Request $request)
    {
        //return $request->all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $monthlyReport = Bill::whereBetween('created_at', [$from_date, $to_date])->get();
        $total_amount = Bill::whereBetween('created_at', [$from_date, $to_date])->get()->sum('amount');
        return view('monthlyReport', compact('monthlyReport', 'from_date', 'to_date', 'total_amount'));
    }
}
