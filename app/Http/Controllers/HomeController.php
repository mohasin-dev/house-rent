<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Floor;
use App\House;
use App\Flat;
use App\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $houses = House::all()->count();
        $floors = Floor::all()->count();
        $flats = Flat::all()->count();
        $customers = Customer::all()->count();
        return view('home2', compact('houses', 'floors', 'flats', 'customers'));
    }
}
