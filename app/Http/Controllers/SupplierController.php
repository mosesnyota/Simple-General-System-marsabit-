<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suppliers;
use DB;
class SupplierController extends Controller
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
        $selectd =  DB::table('expenses')
        ->select(DB::raw('count(expense_amount) AS total'))
        ->where('cur_status', '!=', 'paid')
        ->get();
      
        $total = 0 ;
        foreach ($selectd as $totald){ 
            $total = $totald->total;
        }
        if( $total ){
            $details['bills'] = $total;
        }else{
            $details['bills'] = 0.0;
        }
       
        $selectdprojects =  DB::table('expenses')
        ->select(DB::raw('SUM(expense_amount) AS unpaid'))
        ->where('cur_status', '!=', 'paid')
        ->get();
      
        $totalunpaid  = 0;
        foreach ($selectdprojects as $totald){ 
            $totalunpaid = $totald->unpaid;
        }
        $details['unpaid'] = $totalunpaid;


        $suppliersNo =  DB::table('suppliers')
        ->select(DB::raw('count(*) AS suppliersno'))
        ->where('deleted_at', '=', NULL)
        ->get();
      
        $suppliersno  = 0;
        foreach ($suppliersNo as $totald){ 
            $suppliersno = $totald->suppliersno;
        }
        $details['totalsuppliers'] = $suppliersno;
        $suppliers =  Suppliers::all() ;
        return view('suppliers.index',compact('suppliers','details'));  
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
        Suppliers::create($input);
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
        $selectd =  DB::table('expenses')
        ->select(DB::raw('SUM(expense_amount) AS total'))
        ->where('supplier_id', '=', $id)
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
       
        $selectdprojects =  DB::table('expenses')
        ->select(DB::raw('SUM(expense_amount) AS unpaid'))
        ->where('supplier_id', '=', $id)
        ->where('cur_status', '!=', 'paid')
        ->get();
      
        $totalunpaid  = 0;
        foreach ($selectdprojects as $totald){ 
            $totalunpaid = $totald->unpaid;
        }
        $details['unpaid'] = $totalunpaid;

        $details['bills'] = 0;
      
        $details['totalsuppliers'] = 1;
        

        $supplier =  Suppliers::find($id) ;
        return view('suppliers.view', compact('supplier','details'));
    }

    public function viewBills($id){
        $details = array();
        $selectd =  DB::table('expenses')
        ->select(DB::raw('SUM(expense_amount) AS total'))
        ->where('supplier_id', '=', $id)
        ->get();
      
        $total = 0 ;
        foreach ($selectd as $totald){ 
            $total = $totald->total;
        }
        if( $total > 0 ){
            $details['total'] = $total;
        }else{
            $details['total'] = 0.0;
        }
       
        $selectdprojects =  DB::table('expenses')
        ->select(DB::raw('SUM(expense_amount) AS unpaid'))
        ->where('supplier_id', '=', $id)
        ->where('cur_status', '!=', 'paid')
        ->get();
      
        $totalunpaid  = 0;
        foreach ($selectdprojects as $totald){ 
            $totalunpaid = $totald->unpaid;
        }
        $details['unpaid'] = $totalunpaid;
        $supplier =  Suppliers::find($id) ;
        $invoices =  DB::table('expenses')
        ->select(DB::raw('expenses.*'))
        ->where('supplier_id', '=', $id)
        ->where('deleted_at', '=', null)
        ->get();
         return view('suppliers.view_invoices', compact('supplier','details','invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier=  Suppliers::find($id) ;
        return view('suppliers.editsuppliers', compact('supplier'));
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
        $suppliers =  Suppliers::find($id) ;
        $suppliers ->supplier_name = $input['supplier_name'];
        $suppliers ->services = $input['services'];
        $suppliers ->address = $input['address'];
        $suppliers ->phone = $input['phone'];
        $suppliers ->email = $input['email'];
      
        
        $suppliers->save();
        return redirect()->action(
            'SupplierController@index'
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
        Suppliers::where('supplier_id',$id)->delete();
        return redirect()->action(
            'SupplierController@index'
        );
    }
}
