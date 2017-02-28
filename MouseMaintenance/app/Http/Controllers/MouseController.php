<?php

namespace App\Http\Controllers;

use App\BloodPressure;
use App\Cage;
use App\Colony;
use App\Tag;
use App\User;
use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mouse;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use DateTime;

class MouseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function group(Request $request){

        $this->validate($request, [
            'group_select_cb' => 'required'
        ]);

        $mice_for_surgery = $request['group_select_cb'];
        $mice = implode(",",$mice_for_surgery);


        if($request->input('submit') == 'surgery'){
            return redirect('surgeries/'.$mice.'/create');
//            return redirect()->action('SurgeryController@create')->with('mice', $mice_for_surgery);
        }else{
            return redirect()->action('TissueController@index');
        }
//        return($request->input('submit'));
    }

    public function index(Request $request)
    {
        $day = date('Y-m-d');
        if(isset($request['pep_mice'])){
            $mice = Mouse::whereDate('end_date', '<', $day)->get();
            $pep = true;
        }else {
            $mice = Mouse::whereDate('end_date', '>=', $day)->orWhere('end_date', '')->orWhere('end_date', null)->get();
            $pep = false;
        }
//        return($mice);
        return view('mice.index', compact('mice', 'pep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $mice = Mouse::all();
        $colonies = Colony::all();
        $users = User::all();
        $cage = Cage::find($request['cage_id']);
        $source = $request['source'];

        return view('mice.create', compact('mice', 'colonies', 'users', 'cage', 'source'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mice_total = $request['mice_number'];
        $females = $request['female_mice_number'];

        $source = $request['source'];

        if($source == 'In house') {
            $cage_id = $request['cage_id'];
            $cage = Cage::find($cage_id);
            $father = $cage->male;
            $mother_one = $request['female_parent'];
            $mother_two = null;
            $mother_three = null;
            date_default_timezone_set('America/Edmonton');
            $DOB = new DateTime($request['date_of_birth']);
            $DOB->modify('+3 week');
            $wean_date = $DOB;
            if ($mother_one == '0') {
                $mother_one = $cage->female_one;
                $mother_two = $cage->female_two;
                $mother_three = $cage->female_three;
            }

                for ($i = 0; $i < $mice_total; $i++) {
                    $mouse = Mouse::create([
                        'colony_id' => $request['colony_id'],
                        'source' => $source,
                        'father' => $father,
                        'mother_one' => $mother_one,
                        'mother_two' => $mother_two,
                        'mother_three' => $mother_three,
                        'birth_date' => $request['date_of_birth'],
                        'wean_date' => $wean_date,
                        'comments' => $request['comments'],
                    ]);
                    $mouse->save();
                }

//            if ($females != 0) {
//                for ($i = 0; $i < $females; $i++) {
//                    $mouse = Mouse::create([
//                        'colony_id' => $request['colony_id'],
//                        'sex' => false,
//                        'source' => $source,
//                        'reserved_for' => '0',
//                        'father' => $father,
//                        'geno_type_a' => 'null',
//                        'geno_type_b' => 'null',
//                        'mother_one' => $mother_one,
//                        'mother_two' => $mother_two,
//                        'mother_three' => $mother_three,
//                        'birth_date' => $request['date_of_birth'],
//                        'wean_date' => 'null',
//                        'end_date' => 'null',
//                        'sick_report' => false,
//                        'comments' => 'null'
//                    ]);
//                    $mouse->save();
//                }
//            }
        }else{
            for($i = 0; $i < $mice_total; $i++) {
                $mouse = Mouse::create([
                    'colony_id' => $request['colony_id'],
                    'sex' => true,
                    'source' => $source,
                    'reserved_for' => false,
                    'father' => 'null',
                    'geno_type_a' => 'null',
                    'geno_type_b' => 'null',
                    'mother_one' => 'null',
                    'mother_two' => 'null',
                    'mother_three' => 'null',
                    'birth_date' => $request['date_received'],
                    'wean_date' => 'null',
                    'end_date' => 'null',
                    'sick_report' => false,
                    'comments' => 'null'
                ]);
                $mouse->save();
            }

            for($i = 0; $i < $females; $i++) {
                $mouse = Mouse::create([
                    'colony_id' => $request['colony_id'],
                    'sex' => false,
                    'source' => $source,
                    'reserved_for' => false,
                    'father' => 'null',
                    'geno_type_a' => 'null',
                    'geno_type_b' => 'null',
                    'mother_one' => 'null',
                    'mother_two' => 'null',
                    'mother_three' => 'null',
                    'birth_date' => $request['date_received'],
                    'wean_date' => 'null',
                    'end_date' => 'null',
                    'sick_report' => false,
                    'comments' => 'null'
                ]);
                $mouse->save();
            }
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
        $colony = Colony::find($mouse->colony_id);

        return view('mice.show', compact('mouse', 'user', 'colony'));
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
        $editMouse = Mouse::find($id);
        $mice = Mouse::all();
        $users = User::all();

        $active_mice = Mouse::whereDate('end_date', '>=', date('Y-m-d'))->orWhere('end_date', '')->orWhere('end_date', null)->get();

        foreach($active_mice as $a_m){
            $active_tags[] = $editMouse->tagPad($a_m->tags->last()->tag_num);
        }

        return view('mice.edit', compact('editMouse', 'colonies', 'users', 'mice', 'active_tags'));
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

        if($request['geno'] == 5){
            $geno_a = 1;
            $geno_b = 1;
        }
        elseif($request['geno'] == 3){
            $geno_a = 1;
            $geno_b = 0;
        }elseif($request['geno'] == 1){
            $geno_a = 0;
            $geno_b = 0;
        }else{
            $geno_a = null;
            $geno_b = null;
        }


        $mouse = Mouse::find($id);
        if(!empty($request['reserved_for'])){
            $mouse->reserved_for = $request['reserved_for'];
        }
        $mouse->sex = $request['sex'];
        $mouse->geno_type_a = $geno_a;
        $mouse->geno_type_b = $geno_b;
        $mouse->father = $request['father'];
        $mouse->mother_one = $request['mother_one'];
        if(!empty($request['mother_two'])) {
            $mouse->mother_two = $request['mother_two'];
        }
        if(!empty($request['mother_three'])) {
            $mouse->mother_three = $request['mother_three'];
        }
        $mouse->birth_date = $request['birth_date'];
        if(!empty($request['wean_date'])) {
            $mouse->wean_date = $request['wean_date'];
        }
        if(!empty($request['end_date'])) {
            $mouse->end_date = $request['end_date'];
        }
        $mouse->sick_report = $isSick;
        $mouse->comments = $request['comments'];
        $mouse->save();


        if (!empty($request['weight'])) {
            if(isset($mouse->weights->last()->weighed_on)){
                if($mouse->weights->last()->weighed_on != $request['weight_date']) {
                    $weight = Weight::create([
                        'weight' => $request['weight'],
                        'weighed_on' => $request['weight_date'],
                        'mouse_id' => $mouse->id
                    ]);
                    $weight->save();
                }
            }else{
                $weight = Weight::create([
                    'weight' => $request['weight'],
                    'weighed_on' => $request['weight_date'],
                    'mouse_id' => $mouse->id
                ]);
                $weight->save();
            }
        }

        if(!empty($request['bp_date'])){
            if(isset($mouse->blood_pressures->last()->taken_on)) {
                if ($mouse->blood_pressures->last()->taken_on != $request['bp_date']) {
                    $bp = BloodPressure::create([
                        'systolic' => 'null',
                        'diastolic' => 'null',
                        'taken_on' => $request['bp_date'],
                        'mouse_id' => $mouse->id
                    ]);
                    $bp->save();
                }
            }else{
                $bp = BloodPressure::create([
                    'systolic' => 'null',
                    'diastolic' => 'null',
                    'taken_on' => $request['bp_date'],
                    'mouse_id' => $mouse->id
                ]);
                $bp->save();
            }
        }

        if($request['lost_tag_cb'] != 1){
            if(isset($mouse->tags->last()->tag_num)){
                if($request['tag_id'] != $mouse->tagPad($mouse->tags->last()->tag_num)) {
                    $tag_num = $request['tag_id'] + 1;
                    $mouse->tags()->attach($request[$tag_num]);
                }
            }else{
                if(!empty($request['tag_id'])) {
                    $tag_num = $request['tag_id'] + 1;
                    $mouse->tags()->attach($tag_num);
                }
            }
        }

        if(!empty($request['new_tag_id'])){
            $tag_num = $request['new_tag_id'] + 1;
            $mouse->tags()->attach($tag_num);
        }


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