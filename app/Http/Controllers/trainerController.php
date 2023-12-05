<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trainerModel;

class trainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainer = trainerModel::all();
    return view('showAllTrainer')->with('trainer',$trainer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trainerObj = new trainerModel;
        $trainerObj->Trainer_Name = $request->Trainer_Name;
        $trainerObj->Trainer_Batch = $request->Trainer_Batch;
        $trainerObj->save();
        return redirect('trainer');
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
        $trainerObj = trainerModel::find($id);
        $trainerObj->Trainer_Name = $request->Trainer_Name;
        $trainerObj->Trainer_Batch = $request->Trainer_Batch;
        $trainerObj->save();
        return redirect('trainer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainerToDelete = trainerModel::find($id);
        $trainerToDelete->delete();
        return redirect('trainer');
    }
}
