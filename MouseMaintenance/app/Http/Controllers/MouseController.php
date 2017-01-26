<?php

namespace App\Http\Controllers;

use App\BloodPressure;
use App\Colony;
use App\User;
use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mouse;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

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
        $mice = Mouse::all();
        $colonies = Colony::all();
        $users = User::all();
        return view('mice.create', compact('mice', 'colonies', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isSick = 0;
        if($request['sick_report']){
            $isSick = $request['sick_report'];
        }

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
            'sick_report' => $isSick,
            'comments' => $request['comments']
        ]);
        $mouse->save();
        $newMouse = DB::table('mice')->orderBy('id', 'desc')->first();

        if($request['weight_one'] or $request['weight_two']){

            $mass = $request['weight_one'].'.'.$request['weight_two'];

            $weight = Weight::create([
                'weight' => $mass,
                'mouse_id' => $newMouse->id,
                'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
                'modified_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
            ]);
            $weight->save();
        }

        if($request['systolic'] and $request['diastolic']) {

            $bloodPressure = BloodPressure::create([
                'systolic' => $request['systolic'],
                'diastolic' => $request['diastolic'],
                'mouse_id' => $newMouse->id,
                'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
                'modified_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
            ]);
            $bloodPressure->save();
        }
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
        $user = User::where('id', $mouse->reserved_for)->get()->first();

        return view('mice.show', compact('mouse', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colonies = Colony::all();
        $mouse = Mouse::find($id);
        $users = User::all();
        return view('mice.edit', compact('mouse', 'colonies', 'users'));
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
        $isSick = 0;
        if($request['sick_report']){
            $isSick = $request['sick_report'];
        }

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
        $mouse->sick_report = $isSick;
        $mouse->comments = $request['comments'];
        $mouse->save();
//
//        $mass = $request['weight_one'].'.'.$request['weight_two'];
//        $weight = Weight::create([
//            'weight' => $mass,
//            'mouse_id' => $newMouse->id,
//            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
//            'modified_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
//        ]);
//        $weight->save();



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