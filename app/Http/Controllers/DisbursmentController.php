<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DisbursmentNew;
use App\Imports\DisbursmentsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DisbursmentsExport;



use SweetAlert;


class DisbursmentController extends Controller
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

    public function exportDisbursementVotehead($id){
        return Excel::download(new DisbursmentsExport($id), 'Disbursments_BudgetLine.xlsx');
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
        $input['voucherdate']  =  date('Y-m-d', strtotime($input['voucherdate']));
        DisbursmentNew::create($input);
        alert()->success('Success', 'Created Successfully');
      
        return back()->withSuccessMessage('Successfully Added');
    }


    public function uploadexcel(Request $request)
    {
        $project_id = $request->project_id;
         $file  = $request->file('import_file');
         $filename =  $file->getClientOriginalName();
        $path = $file->storeAs('', $filename);
        $disimport = new DisbursmentsImport($project_id);
        Excel::import($disimport, $file);
        alert()->success('Successfully Imported Data from File.', '');
        
        return back()->with('success', 'Successfully Imported Data from File');
    
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
        $disburs = DisbursmentNew::find($id) ;

        //alert()->success('Success!', 'Updated Successfully');
        return view('disbursments.edittransaction', compact('disburs'));

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
       
        
        $disburs = DisbursmentNew::find($id) ;
        $disburs ->voucherno = $input['voucherno'];
        $disburs ->narration = $input['narration'];
        $disburs ->debit = $input['debit'];
        $disburs ->paid_to = $input['paid_to'];
        $disburs ->chequeno = $input['chequeno'];
       
        $disburs->save();
        return redirect()->action(
            'ProjectsController@show',$disburs->project_id
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
        DisbursmentNew::where('disbursment_id',$id)->delete();
        return back();
    }
}
