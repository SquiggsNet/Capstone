<?php

namespace App\Http\Controllers;

use App\Mouse;
use App\Tag;
use Illuminate\Http\Request;
use App\Colony;
use App\Http\Requests;

class ColonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colonies = Colony::all();
        return view('colonies.index', compact('colonies', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colonies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $colony = Colony::create([
            'name' => $request['name']
        ]);
        $colony->save();
        return redirect()->action('ColonyController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colony = Colony::with('mice.tags')->find($id);

        return view('colonies.show', compact('colony', 'mice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colony = Colony::find($id);
        return view('colonies.edit', compact('colony'));
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
        $colony = Colony::find($id);
        $colony->name = $request['name'];
        $colony->save();
        return redirect()->action('ColonyController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $colony = Colony::find($id);
        $colony->delete();
        return redirect()->action('ColonyController@index');
    }
}
