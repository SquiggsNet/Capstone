<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Colony;
use App\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

                    //Remove comments to re-enable authentication
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
        return view('home', compact('colonies', 'storages'));
    }
}
