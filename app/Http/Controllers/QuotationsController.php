<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use App\Quotation;
use App\Customer;
use App\QuotationPDF;
use App\Course;
use App\QuotationDetails;
use App\Invoice;
use App\InvoiceDetails;



class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices  =  DB::table('quotations')
        ->join('quotation_details', 'quotations.invoice_id', '=', 'quotation_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'quotations.customer_id')
        ->join('courses', 'courses.course_id', '=', 'quotations.course_id')
        ->select(DB::raw('course_name,customer_names,narration,invoice_date,quotations.invoice_id, cur_status,SUM(unit_cost * quantity) AS amount'))
        ->where('quotations.deleted_at', '=', NULL)
        ->groupBy('quotations.invoice_id')
        ->orderBy('invoice_date','DESC')
        ->get();

    
        return view('quotations.index',compact('invoices'));  
       
    }

    


      
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $departments = Course::all();
        return view('quotations.quotation',compact('customers','departments'));
    }

    public function quotationestimates($id){
        $invoice = Quotation::find($id);
        return view('quotations.estimates',compact('invoice'));
    }


    public function makeinvoice($id){
        
        $quotation = Quotation::find($id);
        $invoice = [];
        $invoice['invoice_date'] = $quotation->invoice_date   ;
        $invoice['customer_id'] = $quotation->customer_id;
        $invoice['due_date'] = $quotation->invoice_date   ;
        $invoice['narration'] = $quotation->narration   ;
        $invoice['course_id'] = $quotation->course_id   ;
        $newID = Invoice::create($invoice)->invoice_id;
        $quotation->cur_status = 'Accepted';
        $quotation->save();

            $details  =  DB::table('quotation_details')
            ->select(DB::raw('quotation_details.*'))
            ->where('deleted_at', '=', NULL)
            ->where('invoice_id', '=', $id)
            ->get();

            foreach($details as $detail){
                $invoicedetail = [];
                $invoicedetail['invoice_id'] = $newID ;
                $invoicedetail['description'] = $detail->description  ;
                $invoicedetail['unit_cost'] = $detail->unit_cost  ;
                $invoicedetail['quantity'] = $detail->quantity  ;
                InvoiceDetails::create( $invoicedetail);
            }
        
       return redirect()->action(
            "QuotationsController@index"
        );


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
                QuotationDetails::create($invdetails);
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



    public function openquotation($id){
        $invoicedetails = QuotationDetails::where("invoice_id","=",$id)->get();
        $invoice4  =  DB::table('quotations')
        ->leftjoin('quotation_details', 'quotations.invoice_id', '=', 'quotation_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'quotations.customer_id')
        ->select(DB::raw('customer_names,quotations.*,SUM(unit_cost * quantity) AS amount'))
        ->where('quotations.deleted_at', '=', NULL)
        ->where('quotation_details.deleted_at', '=', NULL)
        ->where('quotations.invoice_id', '=', $id)
        ->groupBy('invoice_id')
        ->get();
        $invoice = null;
        foreach($invoice4 as $env){
            $invoice = $env;
        }

        

        return view("quotations.view",compact("invoice","invoicedetails"));
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
        $input['due_date'] = date('Y-m-d', strtotime($input['invoice_date'])); 
        $id = Quotation::create($input)->invoice_id;

        return redirect()->action(
            "QuotationsController@quotationestimates", $id
        );

        
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
        $quotation = Quotation::find($id);
        $customers = Customer::all();
        $departments = Course::all();
        return view('quotations.edit',compact('quotation','departments','customers'));

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
        $quotation = Quotation::find($id);
        $quotation->narration = $input['narration'];
        $quotation->invoice_date = date('Y-m-d', strtotime($input['invoice_date']));
        $quotation->customer_id = $input['customer_id'];
        $quotation->course_id = $input['course_id'];
        $quotation->save();

        return redirect()->action(
            "QuotationsController@openquotation", $id
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
        QuotationDetails::where('invoice_id',$id)->delete();
        Quotation::where('invoice_id',$id)->delete();
        return redirect()->action(
            "QuotationsController@index"
        ); 
        
    }


   
public function destroyitem($invoice_id,$detailid){  
        
        QuotationDetails::where('detail_id',$detailid)->delete();
        return redirect()->action(
            "QuotationsController@openquotation", $invoice_id
        ); 
    }


    
    public function itemedit($invoice_id,$invoicedetails_id){
        $details = QuotationDetails::find($invoicedetails_id);
        return view('quotations.editdetails',compact('details'));
    }


    public function saveediteditem($invoice_id,$invoicedetails_id,Request $request){

        $input = $request->all();
        $id =  $input['detail_id'];
        $details = QuotationDetails::find($id);
        $details['quantity'] =  $input['quantity'];
        $details['description'] =  $input['description'];
        $details['unit_cost'] =  $input['unit_cost'];
        $details->save();

        return redirect()->action(
            "QuotationsController@openquotation", $details->invoice_id
        ); 

    }

    public function deletedetail($invoice_id,$detailid){
        $details =  QuotationDetails::find($detailid) ;

        
        QuotationDetails::where('detail_id',$detailid)->delete();
        
        return redirect()->action(
            "QuotationsController@openquotation", $details->invoice_id
        ); 
    }




    
    public function printpdf($id){
        $invoicedetails = QuotationDetails::where("invoice_id","=",$id)->get();
        $invoice4  =  DB::table('quotations')
        ->leftjoin('quotation_details', 'quotations.invoice_id', '=', 'quotation_details.invoice_id')
        ->join('customers', 'customers.customer_id', '=', 'quotations.customer_id')
        ->select(DB::raw('customers.*,quotations.*,SUM(unit_cost * quantity) AS amount'))
        ->where('quotations.deleted_at', '=', NULL)
        ->where('quotation_details.deleted_at', '=', NULL)
        ->where('quotations.invoice_id', '=', $id)
        ->groupBy('invoice_id')
        ->get();
        

        $invoice = null;

        foreach($invoice4 as $env){
            $invoice = $env;
        }

        $pdf = new QuotationPDF();
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
        $pdf-> Cell(70, 10, "Total",1, 0, 'L', 0, '');
        $pdf-> Cell(40, 10, number_format($totalAmount,2),1, 0, 'R', 0, '');
       
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
        $pdf-> Cell(120, 6, "2. Payment through Mpesa Paybill",0, 0, 'L', 0, '');
        $pdf->Ln();
        $pdf-> Cell(120, 6, "3. Prices indicated on the Quotation are valid for one month",0, 0, 'L', 0, '');
        $pdf->Output();
        exit;
    }


}
