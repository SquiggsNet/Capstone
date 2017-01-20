<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mouse;
use App\Http\Requests;

class MouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mice = Mouse::all();
        return view('mice.index', compact('mice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mouse = Mouse::create([
            'colony_id' => $request['colony_id'],
            'reserved_for' => $request['reserved_for'],
            'sex' => $request['sex'],
            'geno_type_a' => $request['geno_type_a'],
            'geno_type_b' => $request['geno_type_b'],
            'father' => $request['father'],
            'mother_one' => $request['mother_one'],
            'mother_two' => $request['mother_two'],
            'birth_date' => $request['birth_date'],
            'wean_date' => $request['wean_date'],
            'end_date' => $request['end_date'],
            'sick_report' => $request['sick_report'],
            'comments' => $request['comments']
        ]);
        $mouse->save();
        return redirect()->action('MouseController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mouse = Mouse::find($id);
        return view('mice.show', compact('mouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mouse = Mouse::find($id);
        return view('mice.edit', compact('mouse'));
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
        $mouse = Mouse::find($id);
        $mouse->colony_id = $request['colony_id'];
        $mouse->reserved_for = $request['reserved_for'];
        $mouse->sex = $request['sex'];
        $mouse->geno_type_a = $request['geno_type_a'];
        $mouse->geno_type_b = $request['geno_type_b'];
        $mouse->father = $request['father'];
        $mouse->mother_one = $request['mother_one'];
        $mouse->mother_two = $request['mother_two'];
        $mouse->birth_date = $request['birth_date'];
        $mouse->wean_date = $request['wean_date'];
        $mouse->end_date = $request['end_date'];
        $mouse->sick_report = $request['sick_report'];
        $mouse->comments = $request['comments'];
        $mouse->save();
        return redirect()->action('MouseController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mouse = Mouse::find($id);
        $mouse->delete();
        return redirect()->action('MouseController@index');
    }
}