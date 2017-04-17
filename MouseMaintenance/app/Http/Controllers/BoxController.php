<?php

namespace App\Http\Controllers;

use App\Colony;
use App\MouseStorage;
use App\Tissue;
use App\Treatment;
use App\User;
use Illuminate\Http\Request;
use App\Box;
use App\Mouse;

use App\Http\Requests;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mice_id)
    {
        $mice_ex = explode(",", $mice_id);
        $mice = Mouse::whereIn('id', $mice_ex)->get();
        $boxes = Box::all(); //orderBy('box')->get();
        $surgeons = User::all();
        $tissues = Tissue::all();


        return view('boxes.create', compact('mice', 'tissues', 'boxes', 'surgeons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get all mice selected for TissueStorage
        $mice = Mouse::whereIn('id', $request['euthanize_mice'])->get();

        $mouse_list = 0;
        foreach($mice as $mouse){
            $box = $request[$mouse_list .'_box'];
            $tissues = $request[$mouse_list .'_tissue'];

            for($i = 0; $i < count($tissues); $i++){
                if($tissues[$i] != 0){

                    //create the Tissue Storage
                    $tissueStorage = MouseStorage::create([
                        'mouse_id' => $mouse->id,
                        'box_id' => $box[0],
                        'tissue_id' => $tissues[$i],
                        'user_id' => $request['surgeon'],
                        'extraction_date' => $request['extraction_date']
                    ]);
                    $tissueStorage->save();
                }

            }
            Mouse::where('id', $mouse->id)->update(['is_alive' => false]);
            $mouse_list++;
        }
        return redirect()->action('StorageController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $box = Box::find($id);

        $tissues = Tissue::all();
        $strains = Colony::all();
        //$genos = Tissue::all();
        $treatments = Treatment::all();

        $tissue_select = 0;
        $strain_select = 0;
        $geno_select = 0;
        $treatment_select = 0;

        $sort_order = "sortBy";
        $sort_by = "extraction_date";



        $storedTissues = MouseStorage::where('box_id', $id)->get();

        return view('boxes.show', compact('box', 'storedTissues', 'tissues', 'strains', 'treatments', 'tissue_select', 'strain_select', 'geno_select', 'treatment_select', 'sort_by', 'sort_order'));
    }

    public function showFiltered($id, Request $request)
    {
        $box = Box::find($id);

        $tissues = Tissue::all();
        $strains = Colony::all();
        $treatments = Treatment::all();

        if ($request['sort_clicked'] == null) {
            $sort_order = "sortBy";
            $sort_by = "extraction_date";
        }
        elseif ($request['sort_clicked'] == "Tissue Region" && $request['sort_by'] == "tissue.name" && $request['sort_order'] == "sortBy"){
            $sort_order = "sortByDesc";
            $sort_by = 'tissue.name';
        }
        elseif ($request['sort_clicked'] == "Tissue Region"){
            $sort_order = "sortBy";
            $sort_by = 'tissue.name';
        }
        elseif ($request['sort_clicked'] == "Strain" && $request['sort_by'] == "mouse.colony.name" && $request['sort_order'] == "sortBy"){
            $sort_order = "sortByDesc";
            $sort_by = 'mouse.colony.name';
        }
        elseif ($request['sort_clicked'] == "Strain"){
            $sort_order = "sortBy";
            $sort_by = 'mouse.colony.name';
        }
        elseif ($request['sort_clicked'] == "Genotype" && $request['sort_by'] == "mouse.genoFormat" && $request['sort_order'] == "sortBy"){
            $sort_order = "sortByDesc";
            $sort_by = 'mouse.genoFormat';
        }
        elseif ($request['sort_clicked'] == "Genotype"){
            $sort_order = "sortBy";
            $sort_by = 'mouse.genoFormat';
        }
        elseif ($request['sort_clicked'] == "Treatment" && $request['sort_by'] == "mouse.treatments" && $request['sort_order'] == "sortBy"){
            $sort_order = "sortByDesc";
            $sort_by = 'mouse.treatments';
        }
        elseif ($request['sort_clicked'] == "Treatment"){
            $sort_order = "sortBy";
            $sort_by = 'mouse.treatments';
        }
        elseif ($request['sort_clicked'] == "Tag#" && $request['sort_by'] == "mouse.tags.last().tag_num" && $request['sort_order'] == "sortBy"){
            $sort_order = "sortByDesc";
            $sort_by = 'mouse.tags.last().tag_num';
        }
        elseif ($request['sort_clicked'] == "Tag#"){
            $sort_order = "sortBy";
            $sort_by = 'mouse.tags.last().tag_num';
        }
        elseif ($request['sort_clicked'] == "Isolation Date" && $request['sort_by'] == "extraction_date" && $request['sort_order'] == "sortBy"){
            $sort_order = "sortByDesc";
            $sort_by = 'extraction_date';
        }
        elseif ($request['sort_clicked'] == "Isolation Date"){
            $sort_order = "sortBy";
            $sort_by = 'extraction_date';
        }
        elseif ($request['sort_clicked'] == "Isolated By" && $request['sort_by'] == "user.first_name" && $request['sort_order'] == "sortBy"){
            $sort_order = "sortByDesc";
            $sort_by = 'user.first_name';
        }
        elseif ($request['sort_clicked'] == "Isolated By"){
            $sort_order = "sortBy";
            $sort_by = 'user.first_name';
        }

        $tissue_select = $request['tissue_select'];
        $strain_select = $request['strain_select'];
        $geno_select = $request['geno_select'];
        $treatment_select = $request['treatment_select'];

        //if Tissue, Strain, Geno, and treatment are selected
        if($tissue_select != "0" && $strain_select != "0" && $geno_select != "0" && $treatment_select != "0"){
            if($geno_select == "1"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 1)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }elseif ($geno_select == "2"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 0)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 0)
                    ->where('geno_type_b', 0)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }
        }

        //if Tissue, Strain and Geno are selected
        elseif($tissue_select != "0" && $strain_select != "0" && $geno_select != "0" ){
            if($geno_select == "1"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 1)
                    ->get();
            }elseif ($geno_select == "2"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 0)
                    ->get();
            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 0)
                    ->where('geno_type_b', 0)
                    ->get();
            }
        }

        //if Tissue, Strain, and treatment are selected
        elseif($tissue_select != "0" && $strain_select != "0" && $treatment_select != "0"){
            $storedTissues = MouseStorage::where('box_id', $id)
                ->where('tissue_id', $tissue_select)
                ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                ->where('colony_id', $strain_select)
                ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                ->where('treatment_id', $treatment_select)
                ->get();
        }

        //if Tissue, Geno, and treatment are selected
        elseif($tissue_select != "0" && $geno_select != "0" && $treatment_select != "0"){
            if($geno_select == "1"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 1)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }elseif ($geno_select == "2"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 0)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 0)
                    ->where('geno_type_b', 0)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }
        }

        //if Strain, Geno, and treatment are selected
        elseif($strain_select != "0" && $geno_select != "0" && $treatment_select != "0"){
            if($geno_select == "1"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 1)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }elseif ($geno_select == "2"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 0)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 0)
                    ->where('geno_type_b', 0)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }
        }

        //if Tissue and Strain are selected
        elseif($tissue_select != "0" && $strain_select != "0"){
            $storedTissues = MouseStorage::where('box_id', $id)
                ->where('tissue_id', $tissue_select)
                ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                ->where('colony_id', $strain_select)
                ->get();
        }

        //if Tissue and Geno are selected
        elseif($tissue_select != "0" && $geno_select != "0"){
            if($geno_select == "1"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 1)
                    ->get();
            }elseif ($geno_select == "2"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 0)
                    ->get();
            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->where('tissue_id', $tissue_select)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 0)
                    ->where('geno_type_b', 0)
                    ->get();
            }
        }

        //if Tissue and Treatment are selected
        elseif($tissue_select != "0" && $treatment_select != "0"){
            $storedTissues = MouseStorage::where('box_id', $id)
                ->where('tissue_id', $tissue_select)
                ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                ->where('treatment_id', $treatment_select)
                ->get();
        }

        //if Strain and Geno are selected
        elseif($geno_select != "0" && $strain_select != "0"){
            if($geno_select == "1"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 1)
                    ->get();
            }elseif ($geno_select == "2"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 0)
                    ->get();
            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('colony_id', $strain_select)
                    ->where('geno_type_a', 0)
                    ->where('geno_type_b', 0)
                    ->get();
            }
        }

        //if strain and treatment are selected
        elseif($strain_select != "0" && $treatment_select != "0"){
            $storedTissues = MouseStorage::where('box_id', $id)
                ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                ->where('colony_id', $strain_select)
                ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                ->where('treatment_id', $treatment_select)
                ->get();
        }

        //geno and treatment
        elseif($geno_select != "0" && $treatment_select != "0"){
            if($geno_select == "1"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 1)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }elseif ($geno_select == "2"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 0)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 0)
                    ->where('geno_type_b', 0)
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
            }
        }

        //if just Tissue selected
        elseif ($tissue_select != "0"){
            $storedTissues = MouseStorage::where('box_id', $id)
                ->where('tissue_id', $tissue_select)
                ->get();
        }

        //if just strain selected
        elseif ($strain_select != "0"){
            $storedTissues = MouseStorage::where('box_id', $id)
                ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                ->where('colony_id', $strain_select)->get();
        }


        //if just geno selected
        elseif ($geno_select != "0"){
            if($geno_select == "1"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 1)
                    ->get();
            }elseif ($geno_select == "2"){
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 1)
                    ->where('geno_type_b', 0)
                    ->get();
            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->where('geno_type_a', 0)
                    ->where('geno_type_b', 0)
                    ->get();
            }
        }

        //if just treatment slected
        elseif ($treatment_select != "0"){
//            if($treatment_select == "untreated"){
//                $storedTissues = MouseStorage::where('box_id', $id)
//                    ->with('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
//                    ->leftjoin('mouse_treatment', 'mouse_treatment.mouse_id','=','mice.id')
//                    ->wherenull('mouse_treatment.mouse_id')
//                    ->get();
//
//            }else{
                $storedTissues = MouseStorage::where('box_id', $id)
                    ->join('mice', 'mice.id', '=', 'mouse_storages.mouse_id')
                    ->join('mouse_treatment', 'mice.id','=','mouse_treatment.mouse_id')
                    ->where('treatment_id', $treatment_select)
                    ->get();
//            }
        }

        else{
            $storedTissues = MouseStorage::where('box_id', $id)->get();
        }

        return view('boxes.show', compact('box', 'storedTissues', 'tissues', 'strains', 'treatments', 'tissue_select', 'strain_select', 'geno_select', 'treatment_select', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
