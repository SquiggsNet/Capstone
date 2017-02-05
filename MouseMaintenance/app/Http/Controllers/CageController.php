<?php

namespace App\Http\Controllers;

use App\Mouse;
use Illuminate\Http\Request;
use App\Cage;
use App\Http\Requests;

class CageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cages = Cage::all();
        return view('cages.index', compact('cages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mice = Mouse::all();
        return view('cages.create', compact('mice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cage = Cage::create([
            'male' => $request['male'],
            'female_one' => $request['female_one'],
            'female_two' => $request['female_two'],
            'female_three' => $request['female_three'],
            'room_num' => $request['room_num']
        ]);
        $cage->save();
        return redirect()->action('CageController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cage = Cage::find($id);
        return view('cages.show', compact('cage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mice = Mouse::all();
        $cage = Cage::find($id);
        return view('cages.edit', compact('cage', 'mice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cage = Cage::find($id);

        $cage->male = $request['male'];
        $cage->female_one = $request['female_one'];
        $cage->female_two = $request['female_two'];
        $cage->female_three = $request['female_three'];
        $cage->room_num = $request['room_num'];

        $cage->save();
        return redirect()->action('CageController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cage = Cage::find($id);
        $cage->delete();
        return redirect()->action('CageController@index');
    }
}
