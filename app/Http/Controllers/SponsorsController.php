<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sponsor;
use DB;
use App\MyPDF;

class SponsorsController extends Controller
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
        $sponsors =  Sponsor::all() ;
        return view('sponsors.index')->with('sponsors',$sponsors);
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
        $date = strtotime($input['startdate']); 
        $input['startdate']  =  date('Y-m-d', $date);
        Sponsor::create($input);
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
        $details = array();
        $selectd =  DB::table('fundings')
        ->select(DB::raw('SUM(final_amount) AS total'))
        ->where('sponsor_id', '=', $id)
        ->get();
      
        $total = 0 ;
        foreach ($selectd as $totald){ 
            $total = $totald->total;
        }
        if( $total ){
            $details['total'] = $total;
        }else{
            $details['total'] = 0.0;
        }
       
        $selectdprojects =  DB::table('projects')
        ->select(DB::raw('count(*) AS projects'))
        ->where('sponsor_id', '=', $id)
        ->get();
      
        $totalprojects  = 0;
        foreach ($selectdprojects as $totald){ 
            $totalprojects = $totald->projects;
        }
        $details['projects'] = $totalprojects;
        $sponsor=  Sponsor::find($id) ;
        return view('sponsors.view', compact('sponsor','details'));
    }


    public function showfundings($id)
    {
        $details = array();
        $selectd =  DB::table('fundings')
        ->select(DB::raw('SUM(final_amount) AS total'))
        ->where('sponsor_id', '=', $id)
        ->get();
      
        $total = 0 ;
        foreach ($selectd as $totald){ 
            $total = $totald->total;
        }
        if( $total ){
            $details['total'] = $total;
        }else{
            $details['total'] = 0.0;
        }

        $selectdprojects =  DB::table('projects')
        ->select(DB::raw('count(*) AS projects'))
        ->where('sponsor_id', '=', $id)
        ->get();
        $totalprojects  = 0;
        foreach ($selectdprojects as $totald){ 
            $totalprojects = $totald->projects;
        }
        $details['projects'] = $totalprojects;

        $fundings =  DB::table('fundings')
        ->select(DB::raw('fundings.*'))
        ->where('sponsor_id', '=', $id)
        ->get();
        $sponsor=  Sponsor::find($id) ;
        return view('sponsors.viewfundings', compact('sponsor','fundings','details'));
    }


    public function showprojects($id)
    {
        $details = array();
        $selectd =  DB::table('fundings')
        ->select(DB::raw('SUM(final_amount) AS total'))
        ->where('sponsor_id', '=', $id)
        ->get();
      
        $total = 0 ;
        foreach ($selectd as $totald){ 
            $total = $totald->total;
        }
        if( $total ){
            $details['total'] = $total;
        }else{
            $details['total'] = 0.0;
        }

        $selectdprojects =  DB::table('projects')
        ->select(DB::raw('count(*) AS projects'))
        ->where('sponsor_id', '=', $id)
        ->get();
        $totalprojects  = 0;
        foreach ($selectdprojects as $totald){ 
            $totalprojects = $totald->projects;
        }
        $details['projects'] = $totalprojects;


        $projects =  DB::table('projects')
        ->select(DB::raw('projects.*'))
        ->where('sponsor_id', '=', $id)
        ->get();


        $sponsor=  Sponsor::find($id) ;
        return view('sponsors.viewprojects', compact('sponsor','projects','details'));
    }

    

    public function printfunds($id){
       
        $fundings =  DB::table('fundings')
        ->select(DB::raw('fundings.*'))
        ->where('sponsor_id', '=', $id)
        ->get();
      
        

        

        $sponsor=  Sponsor::find($id) ;
        $pdf = new MyPDF();
       $pdf-> SetWidths(7);
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',14);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "Funds Received from ". $sponsor->sponsornames,0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);

     
        //table header
$pdf->SetFillColor(157, 245, 183);
$pdf->setFont("times", "", "11");

$pdf->Ln();
$pdf->Cell(105, 7, "RECEIVED FUNDS", 1, 0, "C", 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->Ln();
$pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(65, 7, "Date", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Currency", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Amount", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Rate", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Amount [Local Cur]", 1, 0, "C", 1);
$pdf->Ln();
$counter = 1; 
$y = $pdf->GetY();
$x = 10;
$fill = 0;

foreach ($fundings as $funding){ 
    
    $pdf->Cell(20, 7,"PRJ0".$counter, 1, 0, "L", $fill);
    $pdf->Cell(65, 7, $funding ->funding_date, 1, 0, "L", $fill);
    $pdf->Cell(50, 7, $funding ->currency, 1, 0, "L", $fill);
    $pdf->Cell(50, 7, number_format($funding->original_amount,2), 1, 0, "R", $fill);
    $pdf->Cell(40, 7, number_format($funding->exchangerate,2), 1, 0, "R", $fill);
    $pdf->Cell(40, 7, number_format($funding ->final_amount,2), 1, 0, "R", $fill);
    
    $counter++;
    
    $y += 7;
    $fill = !$fill;
    if ($y > 160) {
        $pdf->AddPage('L');
        $pdf->SetFillColor(157, 245, 183);
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 45);

        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(65, 7, "Date", 1, 0, "C", 1);
        $pdf->Cell(50, 7, "Currency", 1, 0, "C", 1);
        $pdf->Cell(50, 7, "Amount", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Rate", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Amount [Local Cur]", 1, 0, "C", 1);

        $pdf->Ln();
        $y = 52;
    }

    $pdf->Ln();
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setXY($x, $y);
}
$pdf->Ln();

$pdf->Output();
exit;


    }

    public function printprojects($id){
       

        
        $projects =  DB::table('projects')
        ->select(DB::raw('projects.*'))
        ->where('sponsor_id', '=', $id)
        ->get();


        $sponsor=  Sponsor::find($id) ;
        $pdf = new MyPDF();
       $pdf-> SetWidths(7);
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',14);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "Projects Funded by ". $sponsor->sponsornames,0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);

     
        //table header
$pdf->SetFillColor(157, 245, 183);
$pdf->setFont("times", "", "11");



$pdf->Ln();
$pdf->Cell(105, 7, "FUNDED PROJECTS", 1, 0, "C", 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->Ln();
$pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(75, 7, "Project", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Location", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Budget", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Start Date", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Cur Status", 1, 0, "C", 1);
$pdf->Ln();
$counter = 1; 
$y = $pdf->GetY();
$x = 10;
$fill = 0;

foreach ($projects as $project){ 
    
    $pdf->Cell(20, 7,"PRJ0".$counter, 1, 0, "L", $fill);
    $pdf->Cell(75, 7, $project ->project_name, 1, 0, "L", $fill);
    $pdf->Cell(50, 7, $project ->location, 1, 0, "L", $fill);
    $pdf->Cell(50, 7, number_format($project->budget,2), 1, 0, "R", $fill);
    $pdf->Cell(40, 7, $project->start_date, 1, 0, "R", $fill);
    $pdf->Cell(40, 7, $project ->cur_status, 1, 0, "R", $fill);
    
    $counter++;
    
    $y += 7;
    $fill = !$fill;
    if ($y > 160) {
        $pdf->AddPage('L');
        $pdf->SetFillColor(157, 245, 183);
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 45);

        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(75, 7, "Project", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Location", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Budget", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Start Date", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Cur Status", 1, 0, "C", 1);

        $pdf->Ln();
        $y = 52;
    }

    $pdf->Ln();
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setXY($x, $y);
}
$pdf->Ln();

$pdf->Output();
exit;


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sponsor=  Sponsor::find($id) ;
        return view('sponsors.editsponsor', compact('sponsor'));
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
        $sponsor =  Sponsor::find($id) ;
        $sponsor ->sponsornames = $input['sponsornames'];
        $sponsor ->contactperson = $input['contactperson'];
        $sponsor ->phone = $input['phone'];
        $sponsor ->email = $input['email'];
        $sponsor ->address = $input['address'];
        
        $sponsor->save();
        return redirect()->action(
            'SponsorsController@index'
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
        Sponsor::where('sponsor_id',$id)->delete();
        return redirect()->action(
            'SponsorsController@index'
        );
    }
}
