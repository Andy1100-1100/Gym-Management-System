<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\memberModel;
use App\Models\trainerModel;

class memberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = memberModel::all();
        $trainer = trainerModel::all();

        return view('showAllMembers')->with('member',$member)->with('trainer',$trainer);
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
        $memberObj = new memberModel;
        $memberObj->Member_Name = $request->Member_Name;
        $memberObj->Member_Phone = $request->Member_Phone;
        $memberObj->trainer_id = $request->trainer_id;
        $memberObj->save();
        return redirect('member');
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
        $memberObj = memberModel::find($id);
        $memberObj->Member_Name = $request->Member_Name;
        $memberObj->Member_Phone = $request->Member_Phone;
        $memberObj->trainer_id = $request->trainer_id;
        $memberObj->save();
        return redirect('member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $memberToDelete = memberModel::find($id);
        $memberToDelete->delete();
        return redirect('member');
    }
}
