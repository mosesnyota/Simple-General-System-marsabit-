<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activities;

class ActivitiesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $input = $request->all();
        $input['start_date']  =  date('Y-m-d', strtotime($input['start_date']));
        $input['deadline_date']  =  date('Y-m-d', strtotime($input['deadline_date']));
        Activities::create($input);
        
       return back()->withSuccessMessage('Successfully Added');
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
        $activity =  Activities::find($id); 
        return view('milestones.editemilestone', compact('activity'));
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
        $input = $request->all();
        $myid = $input['userId'];
        $date = strtotime($input['activityenddate']);    
        $Activity = Activities::find($myid);
        
        $Activity->completion_date = date('Y-m-d', $date);
        $Activity->cur_status = $input['curstatus'];
        
        $Activity->save();
       
        return redirect()->action(
            'ProjectsController@show',$Activity->project_id
        );
    }

    public function saveupdated(Request $request, $id){

        $input = $request->all();
        $Activity = Activities::find($id);
        $start = strtotime($input['start_date']); 
        $deadline = strtotime($input['deadline_date']); 

        $Activity->start_date = date('Y-m-d', $start);
        $Activity->deadline_date = date('Y-m-d', $deadline);
        $Activity->activityname = $input['activityname'];

        $Activity->save();

        return redirect()->action(
            'ProjectsController@show',$Activity->project_id
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Activity = Activities::find($id);
        $project_id = $Activity->project_id;
        Activities::where('activity_id',$id)->delete();
        return redirect()->action(
            'ProjectsController@show',$project_id
        );
    }
}
