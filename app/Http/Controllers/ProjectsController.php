<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Sponsor;
use App\Project;
use App\Activities;
use App\Votehead;
use App\DisbursmentNew;
use PDF;
use DB;
use App\MyPDF;
use App\PettyCashPDF;

use SweetAlert;


class ProjectsController extends Controller
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
        //get details of all projects
        $projects =  Project::all();
        $projects2 =  DB::table('projects')
        ->select(DB::raw('project_id,project_name,location,start_date,deadline,sponsor_id,staff_id,budget,cur_status,details,created_at,updated_at,DATEDIFF(deadline, start_date) AS days'))
        ->get();

        $completedactivities = DB::table('activities')
            ->join('projects', 'projects.project_id', '=', 'activities.project_id')
            ->select(DB::raw(' projects.project_id, SUM(DATEDIFF(activities.deadline_date , activities.start_date) ) AS activitydays '))
            ->where('activities.cur_status', '=', 'Completed')
            ->groupBy('projects.project_id')
            ->get();

            $completionStatus = array();
            foreach ($projects as $project){ 
                $val = $project->project_id;
                $completionStatus[$val] =  0;
            }

            foreach ($completedactivities as $activity1){ 
                $val = $activity1->project_id;
                $completionStatus[$val] =  $activity1->activitydays;
            }
            
        //this section checks the number of all active projects
        $countprojects =  DB::table('projects')
            ->select(DB::raw('COUNT(*) AS total'))
            ->where('cur_status', '=', 'Active')
            ->where('deleted_at', '=', NULL)
            ->get();
    
            $ongoingprojects = 0 ;
            foreach ($countprojects as $totald){ 
                $ongoingprojects = $totald->total;
            }
        $projects->projectcnt = $ongoingprojects;


        //This section gets the number of completed projects

        $completed =  DB::table('projects')
            ->select(DB::raw('COUNT(*) AS total'))
            ->where('cur_status', '=', 'Complete')
            ->where('deleted_at', '=', NULL)
            ->get();
    
            $completedprojects = 0 ;
            foreach ($completed as $totald){ 
                $completedprojects = $totald->total;
            }
        $projects->completedprojects = $completedprojects;



        //get total budget expenditure per project
        $voteheadtotals =  DB::table('disbursment_news')
        ->select(DB::raw('project_id, SUM(debit) AS total'))
        ->where('deleted_at', '=', NULL)
        ->groupBy('project_id')
        ->get();

        $mytotals = array();
        foreach ($voteheadtotals as $totald){ 
            $val = $totald->project_id;
            $mytotals[$val] =  $totald->total;
        }

        return view('projects.index', compact('projects','mytotals','projects2','completionStatus'));
        
    }



    public function budgetstatement($id){
        $disbursments = DB::table('disbursment_news')
            ->select('disbursment_news.*')
            ->where('disbursment_news.votehead_id', '=', $id)
            ->where('disbursment_news.deleted_at', '=', NULL)
            ->orderBy('disbursment_news.created_at', 'DESC')
            ->get();

            $votehead =  Votehead::find($id); 


            $pdf = new MyPDF();
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',14);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);

        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "Budget Line:  ".$votehead->votehead_name,0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);
        $pdf-> Cell(40, 10, "Code",1, 0, 'C', 1, '');
        $pdf-> Cell(35, 10, "Date",1, 0, 'C', 1, '');
        $pdf-> Cell(105, 10, "Narration",1, 0, 'C', 1, '');
        $pdf-> Cell(60, 10, "Paid To",1, 0, 'C', 1, '');
        $pdf-> Cell(40, 10, "Amount",1, 0, 'C', 1, '');
       
        $pdf->Ln();

        
        $pdf->SetWidths(array(40,35,105,60,40));
        $aligns = array('C','C','L','L','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        $current_balance = 0;
        foreach($disbursments as $transaction){
            $fill =  !$fill;
            $current_balance += $transaction->debit;
            $pdf->Row(array( 
                $transaction->voucherno,
                date_format(date_create($transaction ->voucherdate),"d-M-Y") ,
                $transaction->narration, 
                $transaction->paid_to, 
                number_format($transaction->debit,2)), $fill);
        }

       
   
        $pdf-> Cell(240, 10, "Total :",1, 0, 'C', 1, '');
        $pdf-> Cell(40, 10,  number_format($current_balance,2),1, 0, 'R', 1, '');
        $pdf->Output();
        exit;





    }

    public function comment($id){
        $project =  Project::find($id) ;
        return view('projects.comment', compact('project'));
    }

    public function updatebudget(Request $request, $id){
        $input = $request->all();
        $project = Project::find($id);
        $project ->budget += $input['amount'];
        
        $project->save();
        alert()->success('Success', 'Projects Successfully Saved');
        return redirect()->action(
            'ProjectsController@show',$project->project_id
        );

    }

    public function savecomment(Request $request,$id){
        $input = $request->all();
        $project =  Project::find($id) ;
        $project->details = $input['details'];
       
        
       
        $project->save();
         return redirect()->action(
             'ProjectsController@show',$project->project_id
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs =  Staff::all() ;
        $sponsors =  Sponsor::all() ;
        return view('projects.newp', compact('staffs','sponsors'));
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
        $date = strtotime($input['start_date']); 
        $input['start_date']  =  date('Y-m-d', $date);
        $input['deadline']  =  date('Y-m-d', strtotime($input['deadline']));
        Project::create($input);
        
        alert()->success('Success', 'Projects Successfully Saved');
        
        return redirect()->action(
            'ProjectsController@index'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project =  Project::find($id) ;
        $projects =  DB::table('projects')
        ->select(DB::raw('project_id,project_name,location,start_date,deadline,sponsor_id,staff_id,budget,cur_status,details,created_at,updated_at,DATEDIFF(deadline, start_date) AS days'))
        ->where('project_id', '=', $id)
        ->where('deleted_at', '=', NULL)
        ->get();
        foreach ($projects as $prj){ 
            $val = $prj->days;
            $project->days =  $val;
        }
        $time = strtotime($project ->start_date);
        $project ->start_date = date('d-m-Y',$time);
        $time2 = strtotime($project ->deadline);
        $project ->deadline = date('d-m-Y',$time2);
        $project ->budget2 = number_format($project ->budget,2);
        $voteheads = Votehead::all()->where('project_id', '=', $id) ;
        $activities = Activities::all()->where('project_id', '=', $id) ;
        $completedactivities = DB::table('activities')
        ->select(DB::raw('project_id, SUM(DATEDIFF(activities.deadline_date , activities.start_date) ) AS activitydays '))
        ->where('cur_status', '=', 'Completed')
        ->where('project_id', '=', $id)
        ->groupBy('project_id')
        ->get();
        $completionStatus = array();
        $completionStatus[$id] =  0;
        foreach ($completedactivities as $activity1){ 
            $val = $activity1->project_id;
            $completionStatus[$val] =  $activity1->activitydays;
        }
        $voteheadtotals =  DB::table('disbursment_news')
        ->select(DB::raw('votehead_id, SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->where('deleted_at', '=', NULL)
        ->groupBy('votehead_id')
        ->get();
        $mytotals = array();
        foreach ($voteheadtotals as $totald){ 
            $val = $totald->votehead_id;
            $mytotals[$val] =  $totald->total;
        }
        $sponsor = Sponsor::find($project ->sponsor_id) ;
        $staff =  Staff::find($project ->staff_id) ;
        //get total budget expenditure for this project
        $totalused =  DB::table('disbursment_news')
        ->select(DB::raw('SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->where('deleted_at', '=', NULL)
        ->get();
        $totalAmountUsed = 0;
        foreach ($totalused as $totald){ 
            $totalAmountUsed = $totald->total;
        }
        $disbursments = DB::table('disbursment_news')
            ->leftJoin('voteheads', 'disbursment_news.votehead_id', '=', 'voteheads.votehead_id')
            ->select('disbursment_news.*', 'voteheads.votehead_name')
            ->where('disbursment_news.project_id', '=', $id)
            ->where('disbursment_news.deleted_at', '=', NULL)
            ->orderBy('disbursment_news.created_at', 'DESC')
            ->get();
        return view('projects.viewproject', compact('disbursments','completionStatus','activities','project','staff','sponsor','voteheads','mytotals','totalAmountUsed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staffs =  Staff::all() ;
        $sponsors =  Sponsor::all() ;
        $project =  Project::find($id) ;
        return view('projects.editproject', compact('project','staffs','sponsors'));
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
        $date = strtotime($input['start_date']); 
        $input['start_date']  =  date('Y-m-d', $date);
        $input['deadline']  =  date('Y-m-d', strtotime($input['deadline']));
        $project = Project::find($id);
        $project ->project_name = $input['project_name'];
        $project ->location = $input['location'];
        $project ->start_date = $input['start_date'];
        $project ->deadline = $input['deadline'];
        $project ->sponsor_id = $input['sponsor_id'];
        $project ->staff_id = $input['staff_id'];
        $project ->budget = $input['budget'];
        $project ->details = $input['details'];
        $project->save();
        alert()->success('Success', 'Projects Successfully Saved');
        return redirect()->action(
            'ProjectsController@show',$project->project_id
        );
    }


    public function printExcel($id){
        $project =  Project::find($id) ;
        $time = strtotime($project ->start_date);
        $project ->start_date = date('d-m-Y',$time);

        $time2 = strtotime($project ->deadline);
        $project ->deadline = date('d-m-Y',$time2);
        $project ->budget2 = number_format($project ->budget,2);

        $voteheads = Votehead::all()->where('project_id', '=', $id) ;
        $activities = Activities::all()->where('project_id', '=', $id) ;

        $disbursments= DB::table('disbursment_news')
            ->leftJoin('voteheads', 'disbursment_news.votehead_id', '=', 'voteheads.votehead_id')
            ->select('disbursment_news.*', 'voteheads.votehead_name')
            ->where('disbursment_news.project_id', '=', $id)
            ->where('disbursment_news.deleted_at', '=', NULL)
            ->orderBy('disbursment_news.voucherdate', 'DESC')
            ->get();

        $voteheadtotals =  DB::table('disbursment_news')
        ->select(DB::raw('votehead_id, SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->where('disbursment_news.deleted_at', '=', NULL)
        ->groupBy('votehead_id')
        ->get();

        $mytotals = array();
        foreach ($voteheadtotals as $totald){ 
            $val = $totald->votehead_id;
            $mytotals[$val] =  $totald->total;
        }
        $sponsor = Sponsor::find($project ->sponsor_id) ;
        $staff =  Staff::find($project ->staff_id) ;
        //get total budget expenditure for this project
        $totalused =  DB::table('disbursment_news')
        ->select(DB::raw('SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->where('disbursment_news.deleted_at', '=', NULL)
        ->get();
        $totalAmountUsed = 0;
        foreach ($totalused as $totald){ 
            $totalAmountUsed = $totald->total;
        }

        return Excel::download(new DisbursmentsExport($id), 'Disbursments_BudgetLine.xlsx');
    }
    public function printPdfReport($id){
        $project =  Project::find($id) ;
        $time = strtotime($project ->start_date);
        $project ->start_date = date('d-m-Y',$time);

        $time2 = strtotime($project ->deadline);
        $project ->deadline = date('d-m-Y',$time2);
        $project ->budget2 = number_format($project ->budget,2);

        $voteheads = Votehead::all()->where('project_id', '=', $id) ;
        $activities = Activities::all()->where('project_id', '=', $id) ;

        $disbursments= DB::table('disbursment_news')
            ->leftJoin('voteheads', 'disbursment_news.votehead_id', '=', 'voteheads.votehead_id')
            ->select('disbursment_news.*', 'voteheads.votehead_name')
            ->where('disbursment_news.project_id', '=', $id)
            ->where('disbursment_news.deleted_at', '=', NULL)
            ->orderBy('disbursment_news.voucherdate', 'DESC')
            ->get();

        $voteheadtotals =  DB::table('disbursment_news')
        ->select(DB::raw('votehead_id, SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->where('disbursment_news.deleted_at', '=', NULL)
        ->groupBy('votehead_id')
        ->get();

        $mytotals = array();
        foreach ($voteheadtotals as $totald){ 
            $val = $totald->votehead_id;
            $mytotals[$val] =  $totald->total;
        }
        $sponsor = Sponsor::find($project ->sponsor_id) ;
        $staff =  Staff::find($project ->staff_id) ;
        //get total budget expenditure for this project
        $totalused =  DB::table('disbursment_news')
        ->select(DB::raw('SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->where('disbursment_news.deleted_at', '=', NULL)
        ->get();
        $totalAmountUsed = 0;
        foreach ($totalused as $totald){ 
            $totalAmountUsed = $totald->total;
        }
        $pdf = new MyPDF();
        $pdf-> SetWidths(7);
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',14);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "Project Report",0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);

     
        //table header
$pdf->SetFillColor(157, 245, 183);
$pdf->setFont("times", "", "11");
$pdf->setXY(10, 60);
$pdf->Cell(130, 7, "PROJECT DETAILS", 1, 0, "L", 1);
$pdf->Ln();
$pdf->Cell(40, 7, "Project Name :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $project->project_name, 1, 0, "L", 0);






$pdf->Ln();
$pdf->Cell(40, 7, "Location :", 1, 0, "L", 0);
$pdf->Cell(90, 7, strip_tags($project->location,'<p>'), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Start Date :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $project->start_date, 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Deadline :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $project->deadline, 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Completed On :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $project->completed_on, 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Total Budget :", 1, 0, "L", 0);
$pdf->Cell(90, 7, number_format($project->budget, 2), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Disbursed Amount :", 1, 0, "L", 0);
$pdf->Cell(90, 7,  number_format( $totalAmountUsed, 2), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Balance :", 1, 0, "L", 0);
$pdf->Cell(90, 7,  number_format($project->budget -  $totalAmountUsed, 2), 1, 0, "L", 0);
$pdf->Ln();

$pdf->Cell(40, 7, "Funded By :", 1, 0, "L", 0);
$pdf->Cell(90, 7,  $sponsor->sponsornames, 1, 0, "L", 0);
$pdf->Ln();

$pdf->Cell(40, 7, "Assigned To :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $staff->firstname." ".$staff->othernames  , 1, 0, "L", 0);
$pdf->Ln();



$pdf->Ln();
$pdf->Cell(105, 7, "BUDGET LINES", 1, 0, "C", 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->Ln();
$pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(55, 7, "Budget Line", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Total Allocation", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Paid Out", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Balance", 1, 0, "C", 1);
$pdf->Ln();
$counter = 1; 
$y = $pdf->GetY();
$x = 10;
$fill = 0;
       

foreach ($voteheads as $votehead){ 
    $voteheadid =  $votehead->votehead_id;
    $pdf->Cell(20, 7,"VTH0".$counter, 1, 0, "L", $fill);
    $pdf->Cell(55, 7, $votehead ->votehead_name, 1, 0, "L", $fill);
    $pdf->Cell(40, 7, number_format($votehead ->amount_allocated,2), 1, 0, "R", $fill);

    if(array_key_exists($voteheadid,$mytotals)){
        $pdf->Cell(40, 7, number_format($mytotals[$voteheadid],2), 1, 0, "R", $fill);
        $pdf->Cell(40, 7, number_format(($votehead ->amount_allocated - $mytotals[$voteheadid]),2), 1, 0, "R", $fill);
    }else{
        $pdf->Cell(40, 7, number_format(0,2), 1, 0, "R", $fill);
        $pdf->Cell(40, 7, number_format(($votehead ->amount_allocated - 0),2), 1, 0, "R", $fill);
    }
    
    $counter++;
    
    $y += 7;
    $fill = !$fill;
    if ($y > 160) {
        $pdf->AddPage('L');
        $pdf->SetFillColor(157, 245, 183);
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 45);

        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(40, 7, "Budget Line", 1, 0, "C", 1);
        $pdf->Cell(35, 7, "Total Allocation", 1, 0, "C", 1);
        $pdf->Cell(30, 7, "Paid Out", 1, 0, "C", 1);
        $pdf->Cell(30, 7, "Balance", 1, 0, "C", 1);

        $pdf->Ln();
        $y = 52;
    }

    $pdf->Ln();
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setXY($x, $y);
}
$pdf->Ln();
$pdf->setXY($x, $y);
$pdf->Ln();
$pdf->SetFillColor(157, 245, 183);
$pdf->Cell(105, 7, "FINANCE DISBURSMENT REPORT", 1, 0, "C", 1);
$pdf->SetFillColor(224, 235, 255);
$y += 7;
$pdf->setXY($x, $y);
$pdf->Ln();
$pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(30, 7, "Date", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Budget Line", 1, 0, "C", 1);
$pdf->Cell(90, 7, "Narration", 1, 0, "C", 1);
$pdf->Cell(50, 7, "Paid To", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Amount", 1, 0, "C", 1);
$y += 7;
$pdf->setXY($x, $y);
$pdf->Ln();
$counter = 1;

$pdf->SetWidths(array(20,30,50,90,50,40));
$aligns = array('L','C','L','L','L','R');
$pdf->SetAligns($aligns );
$pdf->SetFillColor(245, 241, 216 );
$fill = 0;
$pdf->SetFillColor(224, 235, 255);
foreach ($disbursments as $disbursment){ 
    
  
    $pdf->Row(array( "TRX0".$counter,
    date("d-m-Y", strtotime($disbursment ->voucherdate)), 
    $disbursment ->votehead_name ,
    $disbursment ->narration, 
    $disbursment ->paid_to , 
    number_format($disbursment ->debit,2)),$fill);
    $counter++;
    $fill = !$fill;
   
}



$pdf->Ln();
$y = $pdf->GetY();
$pdf->setXY($x, $y);
$pdf->Ln();
$pdf->Cell(105, 7, "", 0, 0, "C", 0);
$pdf->Ln();
$pdf->SetFillColor(157, 245, 183);
$pdf->Cell(105, 7, "CRITICAL MILESTONES : Y = ". $y, 1, 0, "C", 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->Ln();
$pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(75, 7, "Activity Name", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Start Date", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Deadline", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Current Status", 1, 0, "C", 1);
$y += 7;
$pdf->Ln();
$counter = 1;
foreach ($activities as $activity){ 
    $pdf->Cell(20, 7,"ACT0".$counter, 1, 0, "L", $fill);
    $pdf->Cell(75, 7, $activity->activityname, 1, 0, "L", $fill);
    $pdf->Cell(30, 7, date("d-m-Y", strtotime($activity ->start_date)), 1, 0, "R", $fill);
    $pdf->Cell(30, 7, date("d-m-Y", strtotime($activity ->deadline_date)), 1, 0, "R", $fill);

    if($activity ->cur_status == "Completed"){
        $pdf->SetFillColor(157, 245, 183);
        $pdf->Cell(40, 7, $activity ->cur_status, 1, 0, "L", 1);
    }
    
    if($activity ->cur_status == "ongoing"){
        $pdf->SetFillColor(247, 219, 134);
        $pdf->Cell(40, 7, "Ongoing", 1, 0, "L", 1);
    }
    $counter++;
    $y += 7;
    $fill = !$fill;
    $y = $pdf->GetY();
    if ($y > 150) {
        $pdf->AddPage('L');
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 45);
        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(55, 7, "Activity Name", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Start Date", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Deadline", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Current Status", 1, 0, "C", 1);
        $pdf->Ln();
        $y = 52;
    }
    $pdf->Ln();
    $pdf->SetFillColor(224, 235, 255);  
    
}
        $pdf->setX(40);
        $pdf->Ln();
        $pdf->Cell(200, 10, "COMMENTS", 1, 0, "C", 1);
       

        $pdf->SetWidths(array(200));
      
        $aligns = array('L');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(245, 241, 216 );
        $fill = 0;
        $pdf->SetFillColor(224, 235, 255);
        $pdf->Ln();
        $pdf->Row(array(strip_tags($project->details)),$fill);
        $pdf->Ln();

        $pdf->Output();
        exit;
     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DisbursmentNew::where('project_id',$id)->delete();
        Votehead::where('project_id',$id)->delete();
        Activities::where('project_id',$id)->delete();
        Project::where('project_id',$id)->delete();

        return redirect()->action(
            'ProjectsController@index'
        );
    }
}