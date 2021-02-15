<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Locations;
use App\ProductCategory;
use App\ProductTransaction;
use App\Reasons;
use App\MyPDF;
use App\MyPDFPortrait;

class ProductsController extends Controller
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
        $products =  DB::table('products')
        ->leftJoin('locations', 'products.store_id', '=', 'locations.store_id')
        ->leftJoin('product_category', 'products.category_id', '=', 'product_category.category_id')
        ->select(DB::raw('products.*,store_name,category_name '))
        ->whereNull('products.deleted_at')
        ->orderBy('product_name','DESC')->get();

        $locations = Locations::All();
        $categories = ProductCategory::All();
      
        $reasons =  DB::table('issue_reasons')
        ->select(DB::raw('issue_reasons.*'))
        ->where('deleted_at', '=', NULL)
        ->orderBy('description')
        ->get();
        return view('products.index', compact('products','locations','categories','reasons')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function report1(Request $request){
        $input = $request->all();
        $startdate =   date('Y-m-d',strtotime( $input['start']));
        $enddate =   date('Y-m-d',strtotime( $input['end']));
        $input['start'] = $startdate;
        $input['end'] = $enddate;
        return view('products.opentransactionsreport',compact('input'));

    }

    
    public function report2(Request $request){
        $input = $request->all();
        $startdate =   date('Y-m-d',strtotime( $input['start']));
        $enddate =   date('Y-m-d',strtotime( $input['end']));
        $input['start'] = $startdate;
        $input['end'] = $enddate;
        return view('products.opensummaryreport',compact('input'));

    }
    

    public function report3(Request $request){
        $input = $request->all();
        $startdate =   date('Y-m-d',strtotime( $input['start']));
        $enddate =   date('Y-m-d',strtotime( $input['end']));
        $input['start'] = $startdate;
        $input['end'] = $enddate;
        return view('products.reasonsreport',compact('input'));

    }


    public function reasonsReport($start,$end){

        $startdate =   date('Y-m-d',strtotime( $start));
        $enddate   =   date('Y-m-d',strtotime( $end));

    

        $transactions =  DB::table('product_transactions')
            ->join('products', 'products.product_id', '=', 'product_transactions.product_id')
            ->join('issue_reasons', 'issue_reasons.reason_id', '=', 'product_transactions.reason_id')
            ->select(DB::raw("products.product_id,issue_reasons.description, `product_name`,units_of_measure ,  SUM(product_transactions.`quantity`) AS transqnt "))
            ->where('product_transactions.deleted_at', '=', NULL)
            ->where('product_transactions.created_at', '>=', $startdate)
            ->where('product_transactions.created_at', '<=', $enddate)
            ->groupBy('product_id')
            ->groupBy('description')
            ->orderBy('product_name','DESC')
            ->get();


            



  
        $pdf = new MyPDFPortrait();
        $pdf-> SetWidths(7);
        $pdf->AddPage();
        $pdf->SetFont('Arial','',11);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln(7);
        $pdf-> Cell(190, 10, "INVENTORY TRANSACTIONS SUMMARY BY REASONS BETWEEN ".date('d-m-Y',strtotime( $start))." to ".date('d-m-Y',strtotime( $end)),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',10);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(65, 10, "Product Name",1, 0, 'C', 1, '');
        $pdf-> Cell(25, 10, "Qnty Issued",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Units",1, 0, 'C', 1, '');
        $pdf-> Cell(60, 10, "Reason",1, 0, 'C', 1, '');
        
        
        
        $pdf->Ln();

        $counter = 1;
        $pdf->SetWidths(array(10,65,25,30,60));
        $aligns = array('L','L','R','L','L');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        foreach($transactions as $transaction){
            $fill =  !$fill;
            $pdf->Row(array( $counter,
            $transaction->product_name,  
            $transaction->transqnt, 
            $transaction->units_of_measure,
            $transaction->description 
            
        ), $fill);
            $counter++;
            
        }
   
        $pdf-> Cell(190, 10, "",1, 0, 'C', 1, '');
      
        $pdf->Output();
        exit;
    }





    


  
    public function summaryReport($start,$end){

        $startdate =   date('Y-m-d',strtotime( $start));
        $enddate   =   date('Y-m-d',strtotime( $end));

    

        $transactions =  DB::table('product_transactions')
            ->join('products', 'products.product_id', '=', 'product_transactions.product_id')
            ->select(DB::raw("products.product_id, `product_name`,units_of_measure , products.`quantity` , SUM(product_transactions.`quantity`) AS transqnt ,0 AS amntbought"))
            ->where('product_transactions.deleted_at', '=', NULL)
            ->where('product_transactions.created_at', '>=', $startdate)
            ->where('product_transactions.created_at', '<=', $enddate)
            ->groupBy('product_id')
            ->orderBy('product_name','DESC')
            ->get();


            $qntybouth =  DB::table('product_transactions')
            ->select(DB::raw("product_id,SUM(`quantity`) AS amnbgt"))
            ->where('product_transactions.deleted_at', '=', NULL)
            ->where('product_transactions.created_at', '>=', $startdate)
            ->where('product_transactions.created_at', '<=', $enddate)
            ->where('product_transactions.trans_type', '=', 'Received Stock')
            ->groupBy('product_id')
            ->get();

         foreach($transactions as $transactiond){

                foreach( $qntybouth  as  $qntybouthd){
                    if($transactiond->product_id == $qntybouthd->product_id){
                        $transactiond->amntbought = $qntybouthd->amnbgt;
                    }
                }

         }



  
        $pdf = new MyPDFPortrait();
        $pdf-> SetWidths(7);
        $pdf->AddPage();
        $pdf->SetFont('Arial','',11);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln(7);
        $pdf-> Cell(190, 10, "INVENTORY TRANSACTIONS SUMMARY BY PRODUCTS BETWEEN ".date('d-m-Y',strtotime( $start))." to ".date('d-m-Y',strtotime( $end)),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',10);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(65, 10, "Product Name",1, 0, 'C', 1, '');
        $pdf-> Cell(25, 10, "Qnty Bght Fwd",1, 0, 'C', 1, '');
        $pdf-> Cell(20, 10, "Qnty Bought",1, 0, 'C', 1, '');
        $pdf-> Cell(25, 10, "Qnty Issued",1, 0, 'C', 1, '');
        $pdf-> Cell(25, 10,  "Current Qnty",1, 0, 'C', 1, '');
        $pdf-> Cell(20, 10,  "Units",1, 0, 'C', 1, '');
        
        $pdf->Ln();

        $counter = 1;
        $pdf->SetWidths(array(10,65,25,20,25,25,20));
        $aligns = array('L','L','R','R','R','R','L');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        foreach($transactions as $transaction){
            $fill =  !$fill;
            $pdf->Row(array( $counter,
            $transaction->product_name, 
            //Calculate ammount brought forward: 
            //amount we have - amount bought + amount issued
            ($transaction->quantity - $transaction->amntbought) + $transaction->transqnt, 
            $transaction->amntbought, 
            $transaction->transqnt, 
            $transaction->quantity, 
            $transaction->units_of_measure
            
        ), $fill);
            $counter++;
            
        }
   
        $pdf-> Cell(190, 10, "",1, 0, 'C', 1, '');
      
        $pdf->Output();
        exit;
    }


        
       

        public function printReport1($start,$end){

            $startdate =   date('Y-m-d',strtotime( $start));
            $enddate   =   date('Y-m-d',strtotime( $end));
    
            
    
            $transactions =  DB::table('product_transactions')
            ->leftjoin('products', 'products.product_id', '=', 'product_transactions.product_id')
            ->leftjoin('issue_reasons', 'issue_reasons.reason_id', '=', 'product_transactions.reason_id')
            ->select(DB::raw('product_transactions.*, product_name,description'))
            ->where('product_transactions.deleted_at', '=', NULL)
            ->where('product_transactions.created_at', '>=', $startdate)
            ->where('product_transactions.created_at', '<=', $enddate)
            ->orderBy('product_transactions.created_at','DESC')
            ->get();
    
    
           
            $pdf = new MyPDF();
            $pdf-> SetWidths(7);
            $pdf->AddPage('L');
            $pdf->SetFont('Arial','',14);
            //Table with 20 rows and 4 columns
            $pdf->SetX(5);
            $pdf->SetFillColor(237, 228, 226);
            
            $pdf->Ln(7);
            $pdf-> Cell(280, 10, "INVENTORY TRANSACTIONS BETWEEN ".date('d-M-Y',strtotime( $start))." and ".date('d-M-Y',strtotime( $end)) . " Printed on : ".date('d-M-Y h:i'),0, 0, 'C', 1, '');
            $pdf->Ln(15);
            $pdf->SetX(10);
            $pdf->SetFont('Times','',12);
            $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
            $pdf-> Cell(55, 10, "Product",1, 0, 'C', 1, '');
           
            $pdf-> Cell(35, 10, "Trns Type",1, 0, 'C', 1, '');
            $pdf-> Cell(30, 10, "Date",1, 0, 'C', 1, '');
            $pdf-> Cell(45, 10, "To",1, 0, 'C', 1, '');
            $pdf-> Cell(45, 10, "Reason",1, 0, 'C', 1, '');
            $pdf-> Cell(20, 10, "Qnty",1, 0, 'C', 1, '');
            $pdf-> Cell(20, 10, "Qnty BF",1, 0, 'C', 1, '');
            $pdf-> Cell(20, 10, "Balance",1, 0, 'C', 1, '');
            $pdf->Ln();
    
            $counter = 1;
            $pdf->SetWidths(array(10,55,35,30,45,45,20,20,20));
            $aligns = array('L','L','L','L','L','L','R','R','R');
            $pdf->SetAligns($aligns );
            $pdf->SetFillColor(224, 235, 255);
            
          
            $fill = 1 ;
            foreach($transactions as $transaction){
                $fill =  !$fill;

               
                $pdf->Row(array( $counter,
                $transaction->product_name,  
                $transaction->trans_type,
                date_format(date_create($transaction ->created_at), "d-M-Y"),
                               
                $transaction->issued_to ,
                $transaction->description ,
                $transaction->quantity ,
                $transaction->qnty_before ,
                $transaction->qnty_after
                ), $fill);
                $counter++;
                $pdf->SetFillColor(224, 235, 255);
                
            }
       
            $pdf-> Cell(280, 10, "",1, 0, 'C', 1, '');
           
            $pdf->Output();
            exit;
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
        Product::create($input);
      
        return redirect()->action(
            'ProductsController@index'
        );
    }

    
    public function receivestock(Request $request)
    {
        $input = $request->all();
        $product_id = $input['product_id'];
        $product =  Product::find($product_id) ;
       
        
        $user = auth()->user()->name;
        $transaction = [] ;
        $transaction['product_id'] = $input['product_id'];
        $transaction['trans_type'] ='Received Stock';
        $transaction['quantity'] = $input['quantity'];
        $transaction['transacted_by'] = $user;
        $transaction['qnty_before'] = $product->quantity;
        $transaction['qnty_after'] = $product->quantity + $input['quantity'];

        $transaction['narration'] ='Issued Items';
        $transaction['issued_to'] ='---';
        $product->buying_price = $input['purchase_price'];
        $product->quantity = $product->quantity + $input['quantity'];
        $product->save();
        
        
        ProductTransaction::create($transaction);


        return redirect()->action(
            'ProductsController@index'
        );
    }


    public function issueproduct(Request $request){
        $input = $request->all();
        $product_id = $input['product_id'];
        $product =  Product::find($product_id) ;
        
        
        $user = auth()->user()->name;
        $transaction = [] ;
        $transaction['product_id'] = $input['product_id'];
        $transaction['trans_type'] ='Issued Items';

        $transaction['narration'] =$input['description'];
        $transaction['issued_to'] =$input['issued_to'];

        $transaction['quantity'] = $input['quantity'];
        $transaction['transacted_by'] = $user;
        $transaction['qnty_before'] = $product->quantity;
        $transaction['qnty_after'] = $product->quantity - $input['quantity'];


        $product->quantity = $product->quantity - $input['quantity'];
        $product->save();
        ProductTransaction::create($transaction);


        return redirect()->action(
            'ProductsController@index'
        );
    }


    public function productmovements(){
    
        $transactions =  DB::table('product_transactions')
        ->leftjoin('products', 'products.product_id', '=', 'product_transactions.product_id')
        ->leftjoin('issue_reasons', 'issue_reasons.reason_id', '=', 'product_transactions.reason_id')
        ->select(DB::raw('product_transactions.*, product_name,description'))
        ->where('product_transactions.deleted_at', '=', NULL)
        ->orderBy('product_transactions.created_at','DESC')
        ->get();
        return view('products.productmovements',compact('transactions'));

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =  Product::find($id) ;

        $transactions =  DB::table('product_transactions')
        ->leftjoin('issue_reasons', 'issue_reasons.reason_id', '=', 'product_transactions.reason_id')
        ->select(DB::raw('product_transactions.*,description'))
        ->where('product_id', '=', $id)
        ->where('product_transactions.deleted_at', '=', NULL)
        ->orderBy('product_transactions.created_at','DESC')
        ->get();
        
        return view('products.producttransactions',compact('product','transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locations = Locations::All();
        $categories = ProductCategory::All();
        $product =  Product::find($id) ;
        return view('products.edit', compact('product','locations','categories')); 
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
        $product = Product::find($id) ;
        $input = $request->all();
        $product ->barcode = $input['barcode'];
        $product ->product_name = $input['product_name'];
        $product ->units_of_measure = $input['units_of_measure'];
        $product ->quantity = $input['quantity'];
        $product ->buying_price = $input['buying_price'];
        $product ->reoder_level = $input['reoder_level'];
        $product ->category_id = $input['category_id'];
        $product ->store_id = $input['store_id'];
        $product->save();
        return redirect()->action(
            'ProductsController@index'
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
      
        Product::where('product_id',$id)->delete();
        return redirect()->action(
            'ProductsController@index'
        );

    }
}