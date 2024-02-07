<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Kids;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $kids = Kids::orderBy('order')->get()->toArray();
        return view('volunteer')->with('kids', $kids);
    }
}
