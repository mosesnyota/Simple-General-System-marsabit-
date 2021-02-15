<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Customer;
use App\Bill;
use App\InvoiceDetails;
use DB;
use App\PDF;



use App\MyPDF;
use App\ProductionInvoicePayment;

use App\PettyCashReceipt;

class InvoicesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }




    public function printpdf($id){
        $invoicedetails = InvoiceDetails::where("invoice_id","=",$id)->get();
        $invoice4  =  DB::table('invoices')
        ->join('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
        ->select(DB::raw('customers.*,invoices.*,SUM(unit_cost * quantity) AS amount'))
        ->where('invoices.deleted_at', '=', NULL)
        ->where('invoice_details.deleted_at', '=', NULL)
        ->where('invoices.invoice_id', '=', $id)
        ->groupBy('invoice_id')
        ->get();

        $invoice = null;

        foreach($invoice4 as $env){
            $invoice = $env;
        }

        $pdf = new PDF();
        $pdf->setValues($invoice->invoice_id, $invoice->invoice_date, $invoice->amount);
        $pdf->AddPage();
        $pdf->SetFont('Times','B',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(10);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->SetFont('Times','B',12);
        $pdf->Ln(10);
        $pdf-> Cell(195, 8, "CUSTOMER'S DETAILS",1, 0, 'C', 1, '');
        $pdf->SetFont('Times','',9);
        $pdf->Ln();
        $pdf-> Cell(195, 35, "",1, 0, 'C', 0, '');
        $pdf->SetFont('Times','',11);
        $pdf->Ln(1);
        $pdf->SetX(10);
        $pdf-> Cell(100, 10, "Customer: ".$invoice->customer_names,0, 0, 'L', 0, '');
        $pdf-> Cell(50, 10, '',0, 0, 'L', 0, '');
        $pdf->SetFont('Times','',10);
       
        $pdf->SetFont('Times','',12);
        $pdf->Ln(7);
        $pdf-> Cell(100, 10, "P.O.Box, ".$invoice->address,0, 0, 'L', 0, '');
        $pdf-> Cell(50, 10, '',0, 0, 'L', 0, '');
        $pdf->SetFont('Times','',10);
       
        $pdf->SetFont('Times','',12);
        $pdf->Ln(7);
        $pdf-> Cell(100, 10, "Phone: ".$invoice->phone,0, 0, 'L', 0, '');
        $pdf->Ln(7);
        $pdf-> Cell(100, 10, "Email: ".$invoice->email,0, 0, 'L', 0, '');
        $pdf->Ln(15);
        $pdf->SetFont('Times','B',12);
        $pdf-> Cell(195, 8, "PARTICULARS",1, 0, 'C', 1, '');
        

        $pdf->Ln(10);
        $pdf->SetFont('Times','',10);
        
        $pdf-> Cell(195, 10, "Narration: ".$invoice->narration,0, 0, 'L', 0, '');
        $pdf->SetFont('Times','',12);
        $pdf->Ln(10);
        $pdf-> Cell(85, 10, "Description",1, 0, 'L', 1, '');
        $pdf-> Cell(40, 10, "Unit Price",1, 0, 'L', 1, '');
        $pdf-> Cell(30, 10, "Qnty",1, 0, 'L', 1, '');
        $pdf-> Cell(40, 10, "Total",1, 0, 'L', 1, '');
        $pdf->SetFont('Times','',9);
       
        $pdf->SetFont('Times','',11);
        $pdf->Ln();


        $pdf->SetWidths(array(85,40,30,40));
        $aligns = array('L','R','R','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        $totalAmount = 0 ;
        foreach($invoicedetails as $transaction){
            $fill =  !$fill;
            $totalAmount +=  $transaction->unit_cost * $transaction->quantity; 
            $pdf->Row(array( $transaction->description,
            number_format($transaction->unit_cost,2), 
            number_format($transaction->quantity,2),
            number_format($transaction->unit_cost * $transaction->quantity,2),
           
        ), $fill);
    
            
        }

        $paid = 0;
        $open3=  DB::select("SELECT SUM(invoice_payment.amount) AS paid FROM `invoice_payment` 
        WHERE deleted_at IS NULL AND invoice_id = $id");


        
        foreach ($open3 as $totald){ 
            $paid = $totald->paid;
        }


        $pdf-> Cell(85, 10, "",0, 0, 'L', 0, '');
        $pdf-> Cell(110, 10, "Summary",1, 0, 'L', 0, '');
        $pdf->Ln();
        $pdf-> Cell(85, 10, "",0, 0, 'L', 0, '');
        $pdf-> Cell(70, 10, "Sub Total",1, 0, 'L', 0, '');
        $pdf-> Cell(40, 10, number_format($totalAmount,2),1, 0, 'R', 0, '');
        $pdf->Ln();
        $pdf-> Cell(85, 10, "",0, 0, 'L', 0, '');
        $pdf-> Cell(70, 10, "Paid",1, 0, 'L', 0, '');
        $pdf-> Cell(40, 10, number_format($paid ,2),1, 0, 'R', 0, '');
        $pdf->Ln();
        $pdf-> Cell(85, 10, "",0, 0, 'L', 0, '');
        $pdf-> Cell(70, 10, "Balance",1, 0, 'L', 0, '');
        $pdf-> Cell(40, 10, number_format($totalAmount - $paid ,2),1, 0, 'R', 0, '');
        $pdf->Ln(20);

        $pdf->SetY(-55);
        $pdf->RoundedRect(10, $pdf->getY(), 120, 30, 5,$corners = '1234', '');
        $pdf->SetFont('Times','BU',10);
        $pdf-> Cell(120, 5, "Terms of Payment",0, 0, 'C', 0, '');
        $pdf->Ln();
        $pdf->SetFont('Times','',10);
        $pdf-> Cell(120, 6, "1. We require an advance payment of 70% along with the confirmation of ",0, 0, 'L', 0, '');
        $pdf->Ln();
        $pdf-> Cell(120, 6, "    the order; Balance payment against delivery",0, 0, 'L', 0, '');
        $pdf->Ln();
        $pdf-> Cell(120, 6, "2. All cheques payable to DON BOSCO EMBU-PRODUCTION",0, 0, 'L', 0, '');
        $pdf->Ln();
        $pdf-> Cell(120, 6, "3. This Invoice/Quotation is valid for one month",0, 0, 'L', 0, '');
        $pdf->Output();
        exit;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice_details = [];
        $currDate = date("Y");
        $selectd =  DB::select("SELECT SUM(unit_cost * quantity) AS income FROM `invoices` JOIN 
        `invoice_details` ON `invoices`.`invoice_id` = `invoice_details`.`invoice_id`
        WHERE invoices.deleted_at IS NULL AND invoice_details.`deleted_at` IS NULL
        AND YEAR(invoice_date) = $currDate ");

        $selectd2 =  DB::select(" SELECT count(invoice_id) as total from invoices
        where invoices.deleted_at IS NULL  AND YEAR(invoice_date) = $currDate ");

        $total = 0 ;
        $income = 0;
        foreach ($selectd as $totald){ 
          
            $income = $totald->income;
        }

        foreach ($selectd2 as $totald){ 
            $total = $totald->total;
            
        }


        $LASTYEAR = $currDate - 1;

        $selectdLASTYEAR =  DB::select("SELECT SUM(unit_cost * quantity) AS income 
        FROM `invoices` JOIN 
        `invoice_details` ON `invoices`.`invoice_id` = `invoice_details`.`invoice_id`
        WHERE invoices.deleted_at IS NULL AND invoice_details.`deleted_at` IS NULL
        AND YEAR(invoice_date) = $LASTYEAR ");

        $selectdLASTYEAR2 =  DB::select(" SELECT count(invoice_id) as total from invoices
        where invoices.deleted_at IS NULL  AND YEAR(invoice_date) = $LASTYEAR ");
        $totalLASTYEAR  = 0;
        $incomeLASTYEAR = 0;
        foreach ($selectdLASTYEAR as $totaldLAST){ 
           
            $incomeLASTYEAR = $totaldLAST->income;
        }

        foreach ($selectdLASTYEAR2 as $totaldLAST){ 
           
            $totalLASTYEAR = $totaldLAST->total;
        }
        

        $open = DB::select("SELECT COUNT(invoices.invoice_id) AS total FROM INVOICES
        WHERE invoices.deleted_at IS NULL AND cur_status !='paid'");

      
        $totalopen = 0 ;
        $totalUnpaid = 0 ;



        foreach ($open as $totald){ 
            $totalopen = $totald->total;
            
        }

       
        $open2 =  DB::select("SELECT SUM(unit_cost * quantity) AS unpaid FROM `invoices` JOIN 
        `invoice_details` ON `invoices`.`invoice_id` = `invoice_details`.`invoice_id`
        WHERE invoices.deleted_at IS NULL AND invoice_details.`deleted_at` IS NULL
        AND cur_status !='paid' ");

        $open3=  DB::select("SELECT SUM(invoice_payment.amount) AS paid FROM `invoices` JOIN 
        `invoice_payment` ON `invoices`.`invoice_id` = `invoice_payment`.`invoice_id`
        WHERE invoices.deleted_at IS NULL AND invoice_payment.`deleted_at` IS NULL
        AND cur_status !='paid' ");



        foreach ($open2 as $totald){ 
           
            $totalUnpaid = $totald->unpaid;
        }

        $totalpaid = 0 ;
        foreach ($open3 as $totald){ 
            $totalpaid = $totald->paid;
        }



        $invoice_details['total_invoices'] =  $total;
        $invoice_details['open_invoices'] = $totalopen;
        $invoice_details['unpaid'] = $totalUnpaid - $totalpaid ;
        $invoice_details['income'] = $income;

        $invoice_details['totalLASTYEAR'] = $totalLASTYEAR;
        $invoice_details['incomeLASTYEAR'] = $incomeLASTYEAR;

        

        $invoices  =  DB::table('invoices')
        ->leftjoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
        ->select(DB::raw('customer_names,narration,invoice_date,invoices.invoice_id, cur_status,SUM(unit_cost * quantity) AS amount'))
        ->where('invoices.deleted_at', '=', NULL)
        ->where('invoice_details.deleted_at', '=', NULL)
        ->groupBy('invoice_id')
        ->orderBy('invoice_date','DESC')
        ->get();


        $paymentsD =   DB::select("SELECT invoice_payment.invoice_id, SUM(invoice_payment.amount) AS paid FROM `invoice_payment` 
            join invoices on invoices.invoice_id = invoice_payment.invoice_id
            WHERE invoice_payment.deleted_at IS NULL  group by invoice_payment.invoice_id");

                $paidVals = [];
                foreach($paymentsD as $pyd){
                    $paidVals[$pyd->invoice_id] = $pyd->paid;
                    
                }


        return view('invoices.index',compact('invoice_details','invoices','bills','paidVals'));
    }

        /**
         * This function enables editing of the payment
         * for a given production invoice. 
         * @Author Moses Nyota
         * Feb 5th 2021 
         * At Don Bosco Embu
         */
    public function editpay($invoice_id,$payment_id){
        

        $invoices  =  DB::table('invoices')
        ->join('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
        ->select(DB::raw('invoices.*, customer_names,SUM(unit_cost * quantity) AS amount'))
        ->where('invoices.invoice_id', '=', $invoice_id)
        ->groupBy('invoices.invoice_id')
        ->get();

        foreach($invoices  as $inv){
            $invoice = $inv;
        }


        $payment = ProductionInvoicePayment::find($payment_id);
        return view('invoices.editpayment',compact('invoice','payment'));
    }

    public function savepayedit(Request $request,$invoice_id,$payment_id ){
        $input = $request->all();
       
        $payment = ProductionInvoicePayment::find($payment_id);
        $payment['payment_date'] = $input['payment_date'];
        $payment['amount'] = $input['amount'];
        $payment['reference'] = $input['reference'];
        $payment['payment_method'] = $input['payment_method'];
        $payment->save();
        return redirect()->action(
            "InvoicesController@openinvoice", $payment->invoice_id
        ); 

    }


    public function deletedetail($invoice_id,$detailid){
        $details =  InvoiceDetails::find($detailid) ;

        
        InvoiceDetails::where('detail_id',$detailid)->delete();
        
        return redirect()->action(
            "InvoicesController@openinvoice", $details->invoice_id
        ); 
    }


    public function invoice(){
        $invoices  =  DB::table('invoices')
        ->join('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
        ->select(DB::raw('customer_names,invoice_date,invoices.invoice_id, cur_status,SUM(unit_cost * quantity) AS amount'))
        ->where('invoices.deleted_at', '=', NULL)
        ->groupBy('invoices.invoice_id')
        ->orderBy('invoice_date','DESC')
        ->get();

    
        return view('invoices.index2',compact('invoices'));   
    }




    public function editinvoicedetails($invoice_id,$invoicedetails_id){
        $details = InvoiceDetails::find($invoicedetails_id);
        return view('invoices.editdetails',compact('details'));
    }

    public function saveediteditem($invoice_id,$invoicedetails_id,Request $request){

        $input = $request->all();
        $id =  $input['detail_id'];
        $details = InvoiceDetails::find($id);
        $details['quantity'] =  $input['quantity'];
        $details['description'] =  $input['description'];
        $details['unit_cost'] =  $input['unit_cost'];
        $details->save();

        return redirect()->action(
            "InvoicesController@openinvoice", $details->invoice_id
        ); 

    }



    public function report1(Request $request){
        $input = $request->all();
        $startdate =   date('Y-m-d',strtotime( $input['start']));
        $enddate =   date('Y-m-d',strtotime( $input['end']));
        $input['start'] = $startdate;
        $input['end'] = $enddate;
        return view('invoices.openreport',compact('input'));

    }

    public function report2(Request $request){
        $input = $request->all();
        $startdate =   date('Y-m-d',strtotime( $input['start']));
        $enddate =   date('Y-m-d',strtotime( $input['end']));
        $input['start'] = $startdate;
        $input['end'] = $enddate;
        return view('invoices.openreport2',compact('input'));

    }

    public function printReport2($start,$end){ 

        $startdate =   date('Y-m-d',strtotime( $start));
        $enddate   =   date('Y-m-d',strtotime( $end));

      
      

        $payments = DB::select("SELECT `invoice_payment`.*, `customer_names`, `narration` FROM `invoice_payment`
        JOIN `invoices` ON invoices.`invoice_id` = invoice_payment.`invoice_id`
        JOIN `customers` ON invoices.`customer_id` = `customers`.`customer_id` 
        where invoice_payment.deleted_at is null and payment_date >= '$startdate' and payment_date <= '$enddate'
        order by payment_date desc");



        $pdf = new MyPDF();
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "Invoice Payments between ".date('d-M-Y',strtotime( $start))." and ".date('d-M-Y',strtotime( $end)),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        
        $pdf->SetFont('Times','',10);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Date",1, 0, 'C', 1, '');
        $pdf-> Cell(90, 10, "Customer",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Invoice",1, 0, 'C', 1, '');
        $pdf-> Cell(40, 10, "Method",1, 0, 'C', 1, '');
        $pdf-> Cell(40, 10, "Ref",1, 0, 'C', 1, '');
        $pdf-> Cell(40, 10, "Amount",1, 0, 'C', 1, '');
      
       
        $pdf->Ln();

        $counter = 1;
        $pdf->SetWidths(array(10,30,90,30,40,40,40));
        $aligns = array('L','L','L','L','L','L','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        $total = 0 ;
        foreach($payments as $transaction){
            $fill =  !$fill;
            $total += $transaction->amount;
            $pdf->Row(array( 
                $counter,
                date_format(date_create($transaction ->payment_date),"d-M-Y") ,
                $transaction ->customer_names , 
                "INV0".$transaction->invoice_id,
                $transaction->payment_method, 
                $transaction->reference, 
                number_format($transaction->amount,2),                                                                        
        ), $fill);
            $counter++;
            
        }
        $pdf-> Cell(240, 10, "Total  ",1, 0, 'R', 1, '');
        $pdf-> Cell(40, 10,   number_format($total,2),1, 0, 'R', 1, '');
       
        
        $pdf->Output();
        exit;
    }
    

    public function printReport($start,$end){
        $startdate =   date('Y-m-d',strtotime( $start));
        $enddate   =   date('Y-m-d',strtotime( $end));

      
        $invoices  =  DB::table('invoices')
        ->join('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
        ->select(DB::raw('customer_names, narration, invoice_date,invoices.invoice_id, cur_status,SUM(unit_cost * quantity) AS amount'))
        ->where('invoices.deleted_at', '=', NULL)
        ->where('invoice_details.deleted_at', '=', NULL)
        ->where('invoice_date', '>=', $startdate)
        ->where('invoice_date', '<=', $enddate)
        ->groupBy('invoices.invoice_id')
        ->orderBy('invoice_date','DESC')
        ->get();


  
        $pdf = new MyPDF();
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "Invoices between ".date('d-M-Y',strtotime( $start))." and ".date('d-M-Y',strtotime( $end)),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        
        $pdf->SetFont('Times','',10);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Inv No",1, 0, 'C', 1, '');
        $pdf-> Cell(100, 10, "Narration",1, 0, 'C', 1, '');
        $pdf-> Cell(50, 10, "Customer",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Date",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Total",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Status",1, 0, 'C', 1, '');
      
        
        $pdf->Ln();

        $counter = 1;
        $pdf->SetWidths(array(10,30,100,50,30,30,30));
        $aligns = array('L','L','L','L','C','R','C');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        $total = 0 ;
        foreach($invoices as $transaction){
            $fill =  !$fill;
            $total += $transaction->amount;
            $pdf->Row(array( 
                $counter,
                "INV0".$transaction->invoice_id,
                $transaction->narration, 
                $transaction ->customer_names , 
                date_format(date_create($transaction ->invoice_date),"d-M-Y") ,
                number_format($transaction->amount,2),
                strtoupper($transaction->cur_status)
        ), $fill);
            $counter++;
            
        }
   
        $pdf-> Cell(220, 10, "Total  ",1, 0, 'R', 1, '');
        $pdf-> Cell(30, 10,   number_format($total,2),1, 0, 'R', 1, '');
        $pdf-> Cell(30, 10, '',1, 0, 'C', 1, '');
        
        $pdf->Output();
        exit;
    }

    public function saveInvoicePayment(Request $request){
        $input = $request->all();
        $input['payment_date'] =  date('Y-m-d', strtotime($input['payment_date'])); 
        $input['amount'] =    str_replace( ',', '', $input['amount'] );
        $id = ProductionInvoicePayment::create($input)->payment_id;
        $invoice_id  =  $input['invoice_id'];
        $invoice4  =  DB::table('invoice_details')
        ->select(DB::raw('SUM(unit_cost * quantity) AS amount'))
        ->where('invoice_details.deleted_at', '=', NULL)
        ->where('invoice_details.invoice_id', '=', $invoice_id)
        ->get();
        $invoice = null;
        foreach($invoice4 as $env){
            $invoice = $env;
        }

        $invoiceTotal = $invoice->amount;
        $open3=  DB::select("SELECT SUM(invoice_payment.amount) AS paid FROM `invoice_payment` 
        WHERE deleted_at IS NULL AND invoice_id = $invoice_id");
        $totalpaid = 0 ;
        foreach ($open3 as $totald){ 
            $totalpaid = $totald->paid;
        }


         $INVC = Invoice::find($invoice_id);
        //Check if fully paid
        if($totalpaid >= $invoiceTotal ){
            $INVC->cur_status = 'Paid';
        }else if($totalpaid < $invoiceTotal){
            $INVC->cur_status = 'Patially Paid';
        }
        $INVC->save();
        return view('invoices.paymentreceipt',compact('id'));
    }


    public function receipt2($id){
        $transactiond = DB::select("SELECT `invoice_payment`.*, `customer_names`, `narration` FROM `invoice_payment`
        JOIN `invoices` ON invoices.`invoice_id` = invoice_payment.`invoice_id`
        JOIN `customers` ON invoices.`customer_id` = `customers`.`customer_id`
        WHERE invoice_payment.`payment_id` = $id");


        $transaction = null;
        foreach($transactiond as $trans){
            $transaction = $trans;
        }


        $pdf = new PettyCashReceipt();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln();


                
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(185, 10, "PAYMENT RECEIPT", 0, 0, "C", 0);
        $pdf->Cell(5, 10, "NO. ".$transaction->payment_id, 0, 0, "R", 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Ln(11);
        $pdf->Cell(156, 7, "Received From: ".$transaction->customer_names, 0, 0, "L", 0);
        $pdf->Cell(28, 7, "Date: ".date('d-M-Y',strtotime( $transaction->payment_date)), 0, 0, "L", 0);
        
        $pdf->SetDash(0.5, 1);
        $pdf->Line(11, 48, 200, 48);
        $pdf->Ln();                       
        $pdf->SetDash(0.5, 1);
        $pdf->Line(39, 58, 200, 58);
        $pdf->SetDash();
        //$pdf->Line(10, 62, 200, 62);
        //$pdf->Line(10, 69, 200, 69);
        //$pdf->Line(10, 83, 200, 83);
       // $pdf->Line(10, 90, 200, 90);

        //$pdf->Line(10, 62, 10, 90);
        //$pdf->Line(40, 62, 40, 90);
        //$pdf->Line(160, 62, 160, 90);
       // $pdf->Line(200, 62, 200, 90);
        $pdf->SetFont('times', 'B', 12);

        //$pdf->Text(14, 67, '1');
       // $pdf->Text(44, 67, 'INVOICE NARRATION');
        //$pdf->Text(165, 67, "AMOUNT");
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetWidths(array(30,120,40));
        
        $pdf->Cell(30, 8, "#", 1, 0, "C", 0);
        $pdf->Cell(120, 8, "Invoice Narration", 1, 0, "C", 0);
        $pdf->Cell(40, 8, "Amount", 1, 0, "C", 0);
        $pdf->Ln();
        $aligns = array('L','L','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetFont('times', '', 11);

        $fill = 1 ;

        $fill =  !$fill;
        $pdf->Row(array("1",$transaction->narration,number_format($transaction->amount,2)),  $fill);

      
        $pdf->Ln();


        //$pdf->Text(14, 79, 'No');
       // $pdf->Text(44, 79, $transaction->narration);
        //$pdf->Text(165, 79, "Ksh. ".number_format($transaction->amount,2));

        //$pdf->Text(14, 88, 'Total');

       // $pdf->Text(165, 88, "Ksh. ".number_format($transaction->amount,2));
       
       
       
        $pdf->SetFont('times', '', 12);
        $pdf->SetDash(0.5, 1);
        $pdf->Cell(100, 9, "Payment Mode: " . "          " . $transaction->payment_method , 0, 0, "L", 0);
        $pdf->Cell(10, 9, "Reference:".$transaction->reference, 0, 0, "L", 0);
        
        $pdf->SetDash(0.5, 1);
        $pdf->Line(45, 102, 100, 102);
        $pdf->SetDash(0.5, 1);
       
        
        
        
        $pdf->SetDash(0.5, 1);
        $pdf->Line(45, 110, 100, 110);
       
        $pdf->Ln();
        $pdf->SetFont('times', 'I', 12);
        $pdf->Cell(100, 9, "You were served by:  ", 0, 0, "L", 0);
        $pdf->Cell(10, 9, "Sign and Stamp :...................................................", 0, 0, "L", 0);
        $pdf->SetDash(0.5, 1);

        
        $pdf->Ln();
        $pdf->SetDash();
        //DRAW AN OUTER BOX
        $pdf->Line(5, 5, 205, 5); //TOP
        $pdf->Line(5, 5, 205, 5);//TOP


        $pdf->Line(5, 5, 5, 125); //SID1
        $pdf->Line(5, 5, 5, 125);//SIDE1

        $pdf->Line(205, 5, 205, 125); //SID2
        $pdf->Line(205, 5, 205, 125);//SIDE2

        $pdf->Line(5, 125, 205, 125); //bTOP
        $pdf->Line(5, 125, 205, 125);//bTOP
        $pdf->SetFont('times', 'I', 9);

        $pdf->Cell(190, 8, "NB: This receipt will be deemed invalid if it doesn't have a valid stamp/seal ", 0, 0, "C", 0);

        $pdf->Output('', 'receipt', false);

      exit;

    }





    public function printPaymentReceipt($id){

        $transactiond = DB::select("SELECT `invoice_payment`.*, `customer_names`, `narration` FROM `invoice_payment`
        JOIN `invoices` ON invoices.`invoice_id` = invoice_payment.`invoice_id`
        JOIN `customers` ON invoices.`customer_id` = `customers`.`customer_id`
        WHERE invoice_payment.`payment_id` = $id");


        $transaction = null;
        foreach($transactiond as $trans){
            $transaction = $trans;
        }

        
        $pdf = new PettyCashReceipt();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln();

        $pdf->SetFillColor(224, 235, 255);
        $pdf->setXY(5, 40);
        $pdf-> Cell(200, 8, "PAYMENT RECEIPT",1, 0, 'C', 1, '');

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
        $pdf->Cell(170, 7, "Payment Details", 1, 0, "L", 1);
        $pdf->Ln();
        $pdf->Cell(40, 7, "Invoice No :", 1, 0, "L", 0);
        $pdf->Cell(130, 7,  $transaction->invoice_id, 1, 0, "L", 0);
        
        $pdf->Ln();
        $pdf->Cell(40, 7, "Payment Date :", 1, 0, "L", 0);
        $pdf->Cell(130, 7, date_format(date_create($transaction ->payment_date),"d-M-Y"), 1, 0, "L", 0);
        $pdf->Ln();
        $pdf->Cell(40, 7, "Amount :", 1, 0, "L", 0);
        $pdf->Cell(130, 7, $transaction->amount, 1, 0, "L", 0);
        $pdf->Ln();
        $pdf->Cell(40, 7, "Method :", 1, 0, "L", 0);
        $pdf->Cell(130, 7, $transaction->payment_method, 1, 0, "L", 0);
        $pdf->Ln();
        $pdf->Cell(40, 7, "Reference :", 1, 0, "L", 0);
        $pdf->Cell(130, 7, $transaction->reference, 1, 0, "L", 0);
        $pdf->Ln();


        $pdf->SetWidths(array(40,130));
        $aligns = array('L','L');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);


        $fill = 1 ;

        $fill =  !$fill;
        $pdf->Row(array("Narration :",$transaction->narration),  $fill);

      
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


    public function reprintReceipt($id){

        return view('invoices.paymentreceipt',compact('id'));

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

    public function pay($id){
        echo "In Pay function";
    }

    public function newinvoice(){
        $customers = Customer::all();
        return view('invoices.invoice',compact('customers'));
    }

    public function showdetails(Request $request){
        $input = $request->all();
        print_r( $input);


    }

    public function jobestimate($id){
        $invoice = Invoice::find($id);
        return view('invoices.estimates',compact('invoice'));
    }

    public function savejobestimate(Request $request){


        $input = $request->all();
        //["'3434'","'223'","'1112'","'Moses'","'34'","'44'"]Ok
        //print($request);
       $users = (string) $request;
       //echo substr($users,1514);
      $filtered = substr($users,strpos( $users , 'Cookie: XSRF-TOKEN='));
      $finalString =  str_replace( '[', '', substr($filtered,122)); 
      $finalString =  str_replace( ']', '', $finalString); 
      $finalString =  str_replace( '\'', '', $finalString); 
      $finalString =  str_replace( "\"", "", $finalString); 
      $explodedArray  = explode(",", $finalString);
     
      //$invoice_id = Invoice::max('invoice_id');
      $counter = 0;
      $descrpt = "";
      $unitprice = 0;
      $qnty = 0;
      $invoice_id = 0;
      foreach ($explodedArray as $valuedd) {

        if( $counter == 0){
            $invoice_id = trim($valuedd);
           
        }
      
        if( $counter == 1){
            $descrpt = $valuedd;
            
        }else  if( $counter == 2){
            $unitprice = $valuedd;
        } if( $counter == 3){
            $qnty = $valuedd;
           
            $invdetails = [];
            $invdetails['invoice_id'] = $invoice_id;
            $invdetails['description'] = $descrpt ;
            $invdetails['unit_cost'] = $unitprice;
            $invdetails['quantity'] =  $qnty ;

           

            try {
                InvoiceDetails::create($invdetails);
            }catch (\Exception $e) {

                return $e->getMessage();
            }
           
            
            $counter = 0;
        }
        $counter++;
      }


      //Successs message has to be returned to Ajax
      echo  $invoice_id;
        
    }
    public function openinvoice($id){
        $invoicedetails = InvoiceDetails::where("invoice_id","=",$id)->get();
        $invoice4  =  DB::table('invoices')
        ->leftjoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
        ->select(DB::raw('customer_names,invoices.*,SUM(unit_cost * quantity) AS amount'))
        ->where('invoices.deleted_at', '=', NULL)
        ->where('invoice_details.deleted_at', '=', NULL)
        ->where('invoices.invoice_id', '=', $id)
        ->groupBy('invoice_id')
        ->get();
        $invoice = null;
        foreach($invoice4 as $env){
            $invoice = $env;
        }

        $open3=  DB::select("SELECT SUM(invoice_payment.amount) AS paid FROM `invoice_payment` 
        WHERE deleted_at IS NULL AND invoice_id = $id"); 


        $totalpaid = 0 ;
        foreach ($open3 as $totald){ 
            $totalpaid = $totald->paid;
        }

        $details['paid'] = $totalpaid;

        $payments = DB::select("SELECT `invoice_payment`.*
        FROM `invoice_payment`
        where deleted_at is null and invoice_id = $id
        order by payment_date desc");



        return view("invoices.view",compact("invoice","invoicedetails","details","payments"));
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
        $input['invoice_date'] =  date('Y-m-d', strtotime($input['invoice_date'])); 
        $input['due_date'] = date('Y-m-d', strtotime($input['due_date'])); 
        $id = Invoice::create($input)->invoice_id;

        return redirect()->action(
            "InvoicesController@jobestimate", $id
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
        //
    }


    public function payments(){ 
        $payments = DB::select("SELECT `invoice_payment`.*, `customer_names`, `narration` 
        FROM `invoice_payment`
        JOIN `invoices` ON invoices.`invoice_id` = invoice_payment.`invoice_id`
        JOIN `customers` ON invoices.`customer_id` = `customers`.`customer_id` 
        WHERE invoice_payment.deleted_at is null and invoices.deleted_at is null 
        order by payment_date desc");

        
        return view('invoices.payments',compact('payments'));
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


    public function defineitems($id){

        $invoicedetails = InvoiceDetails::where("invoice_id","=",$id)->get();
        $invoice4  =  DB::table('invoices')
        ->leftjoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
        ->select(DB::raw('customer_names,invoices.*,SUM(unit_cost * quantity) AS amount'))
        ->where('invoices.deleted_at', '=', NULL)
        ->where('invoices.invoice_id', '=', $id)
        ->groupBy('invoice_id')
        ->get();
        $invoice = null;
        foreach($invoice4 as $env){
            $invoice = $env;
        }


        return view('invoices.defineitems',compact('invoicedetails','invoice'));
    }



    public function edititem($invoiceid,$itemid){
        echo $invoiceid."   ITEM  ".$itemid;
    }


    public function additems($invoiceid,$itemid){
    
        $invoices  =  DB::table('invoices')
        ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
        ->select(DB::raw('customer_names,narration'))
        ->where('invoices.deleted_at', '=', NULL)
        ->where('invoices.invoice_id', '=', $invoiceid)
        ->get();

        $invoice = null;
        foreach( $invoices as $in){
            $invoice = $in;
        }

        $item = InvoiceDetails::find($itemid);
        return view('invoices.estimates',compact('invoiceid','invoice','itemid','item'));
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
