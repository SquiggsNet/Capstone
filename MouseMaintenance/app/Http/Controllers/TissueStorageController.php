<?php

namespace App\Http\Controllers;

use App\MouseStorage;
use Illuminate\Http\Request;
use App\Box;
use App\Mouse;
use App\Tissue;

use App\Http\Requests;

class TissueStorageController extends Controller
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
        $boxes = Box::where('storage_id', "1")->get(); //orderBy('box')->get();
        $tissues = Tissue::all();


        return view('tissuestorages.create', compact('mice', 'tissues', 'boxes'));
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
                    ]);
                    $tissueStorage->save();
                }

            }
            Mouse::where('id', $mouse->id)->update(['is_alive' => false]);
            $mouse_list++;
        }

        return redirect()->action('storages@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
