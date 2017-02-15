<?php

namespace App\Http\Controllers;
use App\Storage;
use Illuminate\Http\Request;

use App\Http\Requests;

class StorageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $storages = Storage::all();
        return view('storages.index', compact('storages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storage = Storage::create([
            'tissue_id' => $request['tissue_id'],
            'type' => $request['type'],
            'freezer' => $request['freezer'],
            'compartment' => $request['compartment'],
            'shelf' => $request['shelf']
        ]);
        $storage->save();
        return redirect()->action('StorageController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $storage = Storage::find($id);
        return view('storages.show', compact('storage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storage = Storage::find($id);
        return view('storages.edit', compact('storage'));
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
        $storage = Storage::find($id);
        $storage->tissue_id = $request['tissue_id'];
        $storage->type = $request['type'];
        $storage->freezer = $request['freezer'];
        $storage->compartment = $request['compartment'];
        $storage->shelf = $request['shelf'];
        $storage->save();
        return redirect()->action('StorageController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storage = Storage::find($id);
        $storage->delete();
        return redirect()->action('StorageController@index');
    }
}
