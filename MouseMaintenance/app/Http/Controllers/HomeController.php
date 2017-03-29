<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Colony;
use App\Storage;
use App\Surgery;
use Illuminate\Http\Request;

class HomeController extends Controller
{


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

        $colonies = Colony::all();
        $storages = Storage::all();
        $surgeries = Surgery::all();
        return view('home', compact('colonies', 'storages', 'surgeries'));
    }
}
