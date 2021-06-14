<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PettyCash;
use App\Petty;
use DB;
use App\PettyCashReceipt;
use App\PettyCashPDF;
use App\DisbursmentNew;


class PettyCashs extends Controller
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
        $transactions =   PettyCash::orderBy('transaction_date','DESC')->get();
        $transactions2 =   PettyCash::where('cur_status','!=','Complete')->orderBy('transaction_date','DESC')->get();
        $balance = Petty::all();
        //This section gets the petty cash balance
        $current_balance = 0;
        foreach ($balance as $bal){ 
            $current_balance = $bal->balance;
        }
        return view('pettycash.index', compact('transactions','current_balance','transactions2'));
        
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
        $date = strtotime($input['transaction_date']); 
        $input['transaction_date']  =  date('Y-m-d', $date);
        $amount = $input['amount'];
        if($input['transactiontype'] == 'Deposit'){
            DB::statement("UPDATE petties SET balance = balance +  $amount");
        }else{
            if($input['cur_status'] == 'Complete' ){
                DB::statement("UPDATE petties SET balance = balance -  $amount");
            }
        }
        $balance = Petty::all();
        //This section gets the petty cash balance
        $current_balance = 0;
        foreach ($balance as $bal){ 
            $current_balance = $bal->balance;
        }
        $input['balance'] =  $current_balance;
        $id = PettyCash::create($input)->transactionid;
        if($input['transactiontype'] == 'Deposit'){
            return back()->withSuccessMessage('Successfully Added');
        }else{
            return view('pettycash.pettycashreceipt',compact('id'));
        }
    }

    public function reprintReceipt($id){
        return view('pettycash.reprintpettycash',compact('id'));
    }

    public function printPettyReceipt($id){
        $transaction = PettyCash::find($id);
        $pdf = new PettyCashReceipt();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln();

        $pdf->SetFillColor(224, 235, 255);
        $pdf->setXY(5, 40);
        $pdf-> Cell(200, 8, "PETTY CASH RECEIPT",1, 0, 'C', 1, '');

        //DRAW AN OUTER BOX
$pdf->Line(5, 5, 205, 5); //TOP
$pdf->Line(5, 5, 205, 5);//TOP


$pdf->Line(5, 5, 5, 125); //SID1
$pdf->Line(5, 5, 5, 125);//SIDE1

$pdf->Line(205, 5, 205, 125); //SID2
$pdf->Line(205, 5, 205, 125);//SIDE2

$pdf->Line(5, 125, 205, 125); //bTOP
$pdf->Line(5, 125, 205, 125);//bTOP
       
      
                //table header
$pdf->SetFillColor(157, 245, 183);
$pdf->setFont("times", "", "11");
$pdf->setXY(10, 51);
$pdf->Cell(170, 7, "Transaction Details", 1, 0, "L", 1);
$pdf->Ln();
$pdf->Cell(40, 7, "Issued to :", 1, 0, "L", 0);
$pdf->Cell(130, 7,  $transaction->issuedto, 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Transaction Date :", 1, 0, "L", 0);
$pdf->Cell(130, 7, date_format(date_create($transaction ->transaction_date),"d-M-Y"), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Amount :", 1, 0, "L", 0);
$pdf->Cell(130, 7, $transaction->amount, 1, 0, "L", 0);
$pdf->Ln();



$pdf->SetWidths(array(40,130));
$aligns = array('L','L');
$pdf->SetAligns($aligns );
$pdf->SetFillColor(224, 235, 255);


    $fill = 1 ;

    $fill =  !$fill;
    $pdf->Row(array("Narration :",$transaction->description),  $fill);

      
        $pdf->Ln();

        $pdf->Cell(20, 7, "Issued By :", 0, 0, "L", 0);
        $pdf->Cell(90, 7,  "__________________________________________", 0, 0, "L", 0);
        $pdf->Cell(20, 7, "Date & Sign : ", 0, 0, "L", 0);
        $pdf->Cell(30, 7,  " _________________________", 0, 0, "L", 0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(20, 7, "Received By :", 0, 0, "L", 0);
        $pdf->Cell(90, 7,  "__________________________________________", 0, 0, "L", 0);
        $pdf->Cell(20, 7, "Date & Sign : ", 0, 0, "L", 0);
        $pdf->Cell(30, 7,  " _________________________", 0, 0, "L", 0);

        $pdf->Line(5, 125, 205, 125); //bTOP



        $pdf->setXY(5, 120);
        $pdf-> Cell(200, 5, "",1, 0, 'C', 1, '');
        $pdf->Output();
        exit;




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
        $transaction =  PettyCash::find($id) ;
        $transaction->transaction_date  =  date('m/d/Y', strtotime($transaction->transaction_date) );
        return view('pettycash.edittransaction', compact('transaction'));
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
        $transaction = PettyCash::find($id) ;
        if($transaction ->transactiontype == 'Deposit'){
            DB::statement("UPDATE petties SET balance = balance -   $transaction->amount ");
        }else{
            DB::statement("UPDATE petties SET balance = balance +  $transaction->amount ");
        }

        $input = $request->all();
        $transaction ->transaction_date   =  date('Y-m-d', strtotime($input['transaction_date']));
        $transaction ->transactiontype = $input['transactiontype'];
        $transaction ->issuedto = $input['issuedto'];
        $transaction ->amount = $input['amount'];
        
        $transaction ->description = $input['description'];
        $transaction ->project_id = $input['project_id'];
        if($transaction ->transactiontype == 'Deposit'){
            DB::statement("UPDATE petties SET balance = balance +   $transaction->amount ");
        }else{
            DB::statement("UPDATE petties SET balance = balance -  $transaction->amount ");
        }
       
        $transaction->save();
      
        return redirect()->action(
            'PettyCashs@index'
        );
    }



    public function complete(Request $request){
        $input = $request->all();
        $id = $input['transaction_id'];
        $amount = $input['amount'];
        $transaction =  PettyCash::find($id) ;
        $transaction -> amount = $amount ;
        $transaction ->cur_status = 'Complete';
        $transaction ->save();
        DB::statement("UPDATE petties SET balance = balance -   $amount ");
        return redirect()->action(
            'PettyCashs@index'
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

        $transaction =  PettyCash::find($id) ;

        if($transaction -> transactiontype == 'Deposit'){
            DB::statement("UPDATE petties SET balance = balance -   $transaction->amount ");
        }else{
            DB::statement("UPDATE petties SET balance = balance +  $transaction->amount ");
        }
        PettyCash::where('transactionid',$id)->delete();
        
        return redirect()->action(
            'PettyCashs@index'
        );
    }


    public function report1(Request $request){
        $input = $request->all();
        $startdate =   date('Y-m-d',strtotime( $input['start']));
        $enddate =   date('Y-m-d',strtotime( $input['end']));
        $input['start'] = $startdate;
        $input['end'] = $enddate;
        return view('pettycash.openreport',compact('input'));

    }


    public function printReport($start,$end){
        $startdate =   date('Y-m-d',strtotime( $start));
        $enddate   =   date('Y-m-d',strtotime( $end));

        $transactions =  PettyCash::orderBy('transaction_date','DESC')
        ->where('transaction_date', '>=', $startdate)
        ->where('transaction_date', '<=', $enddate)
        ->get();


        $balance = Petty::all();
        //This section gets the petty cash balance
        $current_balance = 0;
        foreach ($balance as $bal){ 
            $current_balance = $bal->balance;
        }
  
        $pdf = new PettyCashPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln(7);
        $pdf-> Cell(195, 10, "Petty Cash Transactions between ".date('d-M-Y',strtotime( $start))." and ".date('d-M-Y',strtotime( $end)),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        
        $pdf->SetFont('Times','',10);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(65, 10, "Description",1, 0, 'C', 1, '');
        $pdf-> Cell(25, 10, "Date",1, 0, 'C', 1, '');
        $pdf-> Cell(35, 10, "To",1, 0, 'C', 1, '');
        $pdf-> Cell(10, 10, "Txt",1, 0, 'C', 1, '');
        $pdf-> Cell(25, 10, "Amount",1, 0, 'C', 1, '');
        $pdf-> Cell(25, 10, "Balance",1, 0, 'C', 1, '');
        
        $pdf->Ln();

        $counter = 1;
        $pdf->SetWidths(array(10,65,25,35,10,25,25));
        $aligns = array('L','L','C','L','C','R','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        foreach($transactions as $transaction){
            $fill =  !$fill;
            $pdf->Row(array( $counter,$transaction->description,
            date_format(date_create($transaction ->transaction_date),"d-M-Y") ,
            $transaction->issuedto, 
            substr($transaction ->transactiontype, 0, 1) , 
            number_format($transaction->amount,2),
            number_format($transaction->balance,2),
           
        
        
        ), $fill);
            $counter++;
            
        }
   
        $pdf-> Cell(195, 10, "Current Balance  ".number_format($current_balance,2),1, 0, 'C', 1, '');
        
        $pdf->Output();
        exit;
    }


}
