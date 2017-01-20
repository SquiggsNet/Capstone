<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surgery;
use App\Http\Requests;

class SurgeryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surgeries = Surgery::all();
        return view('surgeries.index', compact('surgeries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surgeries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $surgery = Surgery::create([
            'user_id' => $request['user_id'],
            'scheduled_date' => $request['scheduled_date'],
            'purpose' => $request['purpose'],
            'comments' => $request['comments']
        ]);
        $surgery->save();
        return redirect()->action('SurgeryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surgery = Surgery::find($id);
        return view('surgeries.show', compact('surgery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $surgery = Surgery::find($id);
        return view('surgeries.edit', compact('surgery'));
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
        $surgery = Surgery::find($id);
        $surgery->user_id = $request['user_id'];
        $surgery->scheduled_date = $request['scheduled_date'];
        $surgery->purpose = $request['purpose'];
        $surgery->comments = $request['comments'];
        $surgery->save();
        return redirect()->action('SurgeryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surgery = Surgery::find($id);
        $surgery->delete();
        return redirect()->action('SurgeryController@index');
    }
}
