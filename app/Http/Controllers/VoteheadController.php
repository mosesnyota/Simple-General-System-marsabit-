<?php

namespace App\Http\Controllers;
use App\Votehead;
use Illuminate\Http\Request;

use App\DisbursmentNew;
use SweetAlert;

class VoteheadController extends Controller
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
        
        Votehead::create($input);
        if(session('success_message')) {
                Alert::success('Success', 'Created Successfully');
        }
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
        $votehead =  Votehead::find($id); 
        return view('voteheads.editvotehead', compact('votehead'));
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
        
        $votehead =  Votehead::find($id); 
        $votehead ->votehead_name  =  $input['votehead_name'];
        $votehead ->amount_allocated =  $input['amount_allocated'];
        $votehead->save();
        return redirect()->action(
            'ProjectsController@show',$votehead->project_id
        );
       
    }


    public function updatevoteheads(Request $request, $id)
    {
        $input = $request->all();
        $myid = $input['disbursmentid'];
      
        $disbursment = DisbursmentNew::find($myid);
        
       
        $disbursment->votehead_id = $input['votehead_id'];
        
        $disbursment->save();
       
        alert()->success('Success!', 'Updated Successfully');
        
        return back()->withSuccessMessage('Successfully Added');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $votehead =  Votehead::find($id); 
        DisbursmentNew::where('votehead_id',$id)->delete();
        Votehead::where('votehead_id',$id)->delete();
       
        return redirect()->action(
            'ProjectsController@show',$votehead->project_id
        );
    }
}
