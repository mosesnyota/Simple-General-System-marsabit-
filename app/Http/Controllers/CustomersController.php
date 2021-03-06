<?php

    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Customer;
    use DB;
    use App\PDFStatement;
    use App\MyPDF;
    class CustomersController extends Controller
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
            $details = array();
            $selectd =  DB::table('invoices')
            ->select(DB::raw('count(invoice_id) AS total'))
            ->get();
          
            $total = 0 ;
            foreach ($selectd as $totald){ 
                $total = $totald->total;
            }
            if( $total ){
                $details['noOfInvoice'] = $total;
            }else{
                $details['noOfInvoice'] = 0.0;
            }
           
            $selectdprojects =  DB::table('invoices')
            ->join('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
            ->select(DB::raw('SUM(unit_cost * quantity) AS unpaid'))
            ->where('cur_status', '!=', 'paid')
            ->get();
          
            $totalunpaid  = 0;
            foreach ($selectdprojects as $totald){ 
                $totalunpaid = $totald->unpaid;
            }
            $details['unpaid'] = $totalunpaid;
    
    
            $customersNo =  DB::table('customers')
            ->select(DB::raw('count(*) AS customersno'))
            ->where('deleted_at', '=', NULL)
            ->get();
          
            $customersno  = 0;
            foreach ($customersNo as $totald){ 
                $customersno = $totald->customersno;
            }
            $details['totalcustomers'] = $customersno;
            $customers =  Customer::all() ;
            return view('customers.index',compact('customers','details'));  
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
            Customer::create($input);
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
            
          
            $selectedCustomer =  DB::select("SELECT SUM(`unit_cost`*`quantity`) AS total FROM `invoice_details` JOIN `invoices`
            ON `invoice_details`.`invoice_id` = `invoices`.`invoice_id`
            WHERE `invoices`.`customer_id` = $id AND invoice_details.deleted_at is null");
          
            $total  = 0;
            foreach ($selectedCustomer as $totald){ 
                $total = $totald->total;
            }

            $unpad =   DB::select("SELECT SUM(invoice_payment.amount) AS paid FROM `invoice_payment` 
            join invoices on invoices.invoice_id = invoice_payment.invoice_id
            WHERE invoice_payment.deleted_at IS NULL AND customer_id = $id");
    
            $totalunpaid  = 0;
            foreach ($unpad as $totald){ 
                $totalunpaid = $totald->paid;
            }

            $details['total'] = $total;
            $details['unpaid'] = $total - $totalunpaid ;
            
    
            $customer =  Customer::find($id) ;
            return view('customers.view', compact('customer','details'));
        }


        public function getStatement($id){

        
            $invoices  =  DB::table('invoices')
            ->leftjoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
            ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
            ->select(DB::raw('customer_names,invoices.*,SUM(unit_cost * quantity) AS amount'))
            ->where('invoices.deleted_at', '=', NULL)
            ->where('invoice_details.deleted_at', '=',NULL)
            ->where('invoices.customer_id', '=', $id)
            ->groupBy('invoice_id')
            ->get();


            $selectedCustomer =  DB::select("SELECT SUM(`unit_cost`*`quantity`) AS total FROM `invoice_details` JOIN `invoices`
            ON `invoice_details`.`invoice_id` = `invoices`.`invoice_id`
            WHERE `invoices`.`customer_id` = $id AND invoice_details.deleted_at is null");
          
            $total  = 0;
            foreach ($selectedCustomer as $totald){ 
                $total = $totald->total;
            }

            $unpad =   DB::select("SELECT SUM(invoice_payment.amount) AS paid FROM `invoice_payment` 
            join invoices on invoices.invoice_id = invoice_payment.invoice_id
            WHERE invoice_payment.deleted_at IS NULL AND customer_id = $id");
    
            $totalunpaid  = 0;
            foreach ($unpad as $totald){ 
                $totalunpaid = $totald->paid;
            }

            $totalInvoices = $total;
            $balance = $total - $totalunpaid ;
            $customer =  Customer::find($id) ;



            $paymentsD =   DB::select("SELECT invoice_payment.invoice_id, SUM(invoice_payment.amount) AS paid FROM `invoice_payment` 
            join invoices on invoices.invoice_id = invoice_payment.invoice_id
            WHERE invoice_payment.deleted_at IS NULL AND customer_id = $id group by invoice_payment.invoice_id");

                $paidVals = [];
                foreach($paymentsD as $pyd){
                    $paidVals[$pyd->invoice_id] = $pyd->paid;
                    
                }
                

                $pdf = new PDFStatement();


                $pdf->setValues($total,$totalunpaid,date('d-m-Y') , $balance);
                $pdf->AddPage();
                $pdf->SetFont('Times','B',13);
                //Table with 20 rows and 4 columns
                $pdf->SetX(5);
                $pdf->SetFillColor(237, 228, 226);
                $pdf->SetFont('Times','B',11);
                $pdf->Ln(6);
                $pdf-> Cell(195, 10, "CUSTOMER'S DETAILS",0, 0, 'C', 1, '');
       
                
                $pdf->SetFont('Times','',11);
                $pdf->Ln(10);
                $pdf->SetX(10);
                $pdf-> Cell(100, 10, $customer->customer_names,0, 0, 'L', 0, '');
                $pdf-> Cell(50, 10, '',0, 0, 'L', 0, '');
                
               
                $pdf->SetFont('Times','',11);
                $pdf->Ln(7);
                $pdf-> Cell(100, 10, "P.O.Box, ".$customer->address,0, 0, 'L', 0, '');
                $pdf-> Cell(50, 10, '',0, 0, 'L', 0, '');
          
                $pdf->Ln(7);
                $pdf-> Cell(100, 10, "Phone: ".$customer->phone,0, 0, 'L', 0, '');
                $pdf-> Cell(50, 10, '',0, 0, 'L', 0, '');

                $pdf->Ln(10);
                $pdf->SetFont('Arial','B',11);
                $pdf-> Cell(195, 10, "INVOICES",0, 0, 'C', 1, '');
               
                $pdf->SetFont('Arial','',10);

               
                $pdf->Ln(14);
                $pdf-> Cell(15, 10, "#",1, 0, 'C', 1, '');
                $pdf-> Cell(75, 10, "Narration",1, 0, 'C', 1, '');
                $pdf-> Cell(25, 10, "Date",1, 0, 'C', 1, '');
                $pdf-> Cell(25, 10, "Total Amount",1, 0, 'C', 1, '');
                $pdf-> Cell(25, 10, "Paid",1, 0, 'C', 1, '');
                $pdf-> Cell(30, 10, "Balance",1, 0, 'C', 1, '');
                $pdf->SetFont('Times','',9);


                $pdf->SetFont('Times','',11);
                $pdf->Ln();


                $pdf->SetWidths(array(15,75,25,25,25,30));
                $aligns = array('R','L','R','R','R','R');
                $pdf->SetAligns($aligns );
                $pdf->SetFillColor(224, 235, 255);
                
            
                $fill = 1 ;
                $totalAmount = 0 ;
                $counter = 1;
                foreach($invoices as $invo){

                    $paid = 0 ;
                    if(array_key_exists($invo->invoice_id, $paidVals)){
                        $paid = $paidVals[$invo->invoice_id];
                    }
                    $fill =  !$fill;
                    $totalAmount +=  $invo->amount; 
                    $pdf->Row(array($counter.". ", $invo->narration,
                    $invo->invoice_date,
                    number_format($invo->amount,2), 

                    number_format( $paid,2),
                    number_format($invo->amount - $paid,2),
                
                ), $fill);
                $counter += 1;

            }

                $pdf->Ln(10);
                $pdf->SetFont('Arial','B',11);
                $pdf-> Cell(195, 10, "PAYMENTS",0, 0, 'C', 1, '');
                $pdf->SetFont('Arial','',10);
                $pdf->Ln(15);

                $pays =   DB::select("SELECT invoice_payment.* FROM `invoice_payment` 
                join invoices on invoices.invoice_id = invoice_payment.invoice_id
                WHERE invoice_payment.deleted_at IS NULL AND customer_id = $id ");
    

                $pdf-> Cell(20, 10, "#",1, 0, 'L', 1, '');
                $pdf-> Cell(50, 10, "Date",1, 0, 'L', 1, '');
                $pdf-> Cell(45, 10, "Method",1, 0, 'L', 1, '');
                $pdf-> Cell(40, 10, "Ref",1, 0, 'L', 1, '');
                $pdf-> Cell(40, 10, "Amount",1, 0, 'L', 1, '');

                $pdf->Ln();
                    $pdf->SetWidths(array(20,50,45,40,40));
                    $aligns = array('L','R','L','L','R');
                    $pdf->SetAligns($aligns );
                    $pdf->SetFillColor(224, 235, 255);
                    

                    $fill = 1 ;
                    $totalAmount = 0 ;
                    $COUNTER = 1;
                    foreach($pays as $PAY){
                        $fill =  !$fill;
                      
                        $pdf->Row(array(  $COUNTER,
                        $PAY->payment_date,
                        $PAY->payment_method,
                        $PAY->reference,
                        number_format($PAY->amount,2), 
                       
                    
                    ), $fill);

                    
                    $COUNTER += 1;

                }


                $pdf->Output();
                exit;
        }
    
        public function viewinvoices($id){
            $details = array();
           
            $invoices  =  DB::table('invoices')
            ->leftjoin('invoice_details', 'invoices.invoice_id', '=', 'invoice_details.invoice_id')
            ->join('customers', 'customers.customer_id', '=', 'invoices.customer_id')
            ->select(DB::raw('customer_names,invoices.*,SUM(unit_cost * quantity) AS amount'))
            ->where('invoices.deleted_at', '=', NULL)
            ->where('invoices.customer_id', '=', $id)
            ->groupBy('invoice_id')
            ->get();


            $selectedCustomer =  DB::select("SELECT SUM(`unit_cost`*`quantity`) AS total FROM `invoice_details` JOIN `invoices`
            ON `invoice_details`.`invoice_id` = `invoices`.`invoice_id`
            WHERE `invoices`.`customer_id` = $id AND invoice_details.deleted_at is null");
          
            $total  = 0;
            foreach ($selectedCustomer as $totald){ 
                $total = $totald->total;
            }

            $unpad =   DB::select("SELECT SUM(invoice_payment.amount) AS paid FROM `invoice_payment` 
            join invoices on invoices.invoice_id = invoice_payment.invoice_id
            WHERE invoice_payment.deleted_at IS NULL AND customer_id = $id");
    
            $totalunpaid  = 0;
            foreach ($unpad as $totald){ 
                $totalunpaid = $totald->paid;
            }

            $details['total'] = $total;
            $details['unpaid'] = $total - $totalunpaid ;
            $customer =  Customer::find($id) ;
            return view('customers.view_invoices', compact('customer','details','invoices'));
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $customer=  Customer::find($id) ;
            return view('customers.editcustomer', compact('customer'));
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
            $customers =  Customer::find($id) ;
            $customers ->customer_names = $input['customer_names'];
        
            $customers ->address = $input['address'];
            $customers ->phone = $input['phone'];
            $customers ->email = $input['email'];
          
            
            $customers->save();
            return redirect()->action(
                'CustomersController@index'
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
            Customer::where('customer_id',$id)->delete();
            return redirect()->action(
                'CustomersController@index'
            );
        }
    }
    