<?php

namespace App\Http\Controllers;

use App\Mouse;
use App\Treatment;
use App\User;
use Illuminate\Http\Request;
use App\Surgery;
use App\Http\Requests;

class SurgeryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $surgeries = Surgery::with('user', 'mice')->get();
        return view('surgeries.index', compact('surgeries', 'user', 'mice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $mice_id
     * @return \Illuminate\Http\Response
     * @internal param $mice
     * @internal param Request $request
     */
    public function create($mice_id)
    {
        $mice_ex = explode(",", $mice_id);
        $mice = Mouse::whereIn('id', $mice_ex)->get();
        $surgeons = User::all();
        $treatments = Treatment::all();

        $t_rows = count($mice) * count($treatments);

        return view('surgeries.create', compact('mice', 'surgeons', 'treatments', 't_rows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mice = Mouse::whereIn('id', $request['surgery_mice'])->get();

        $surgery = Surgery::create([
            'user_id' => $request['surgeon'],
            'scheduled_date' => $request['scheduled_date'],
            'treatment' => $request['treatment'],
            'dose' => 'null',
            'purpose' => 'null',
            'comments' => $request['comments']
        ]);
        $surgery->save();

        foreach($mice as $mouse){
            $surgery->mice()->attach($mouse->id);
        }

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
        $surgery = Surgery::with('user', 'mice')->find($id);
        return view('surgeries.show', compact('surgery', 'user', 'mice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $surgery = Surgery::with('user', 'mice')->find($id);
        $surgeons = User::all();
        return view('surgeries.edit', compact('surgery', 'user', 'mice', 'surgeons'));
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
