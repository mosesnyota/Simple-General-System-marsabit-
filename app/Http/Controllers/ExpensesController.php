<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Expenses;
use App\Sponsor;
use App\ExpenseCategory;
use App\Suppliers;

use DB;
use App\MyPDF;

class ExpensesController extends Controller
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
        $expenses =   DB::table('expenses')
        ->join('suppliers', 'expenses.supplier_id', '=', 'suppliers.supplier_id')
        ->select(DB::raw('expenses.* ,   supplier_name'))
        ->where('expenses.deleted_at', '=', NULL)
        ->orderBy('expense_date','DESC')
        ->get();
      


        $categories = ExpenseCategory::all() ;

        $expense = array();
        $curyearfunds =  DB::table('expenses')
        ->select(DB::raw('sum(expense_amount) as total'))
        ->whereRAW('YEAR(expense_date) =?', [ date("Y")])
        ->where('deleted_at', '=', NULL)
        ->get();

        foreach ($curyearfunds as $totald){ 
            $expense['thisyear'] =  $totald->total;
        }

        $curmonth =  DB::table('expenses')
        ->select(DB::raw('COUNT(expense_amount) as total'))
        ->where('deleted_at', '=', NULL)
        ->where('cur_status', '!=', 'paid')
        ->get();

        $suppliers = Suppliers::all();

        foreach ($curmonth as $totalds){ 
            $expense['unpaidCount'] =  $totalds->total;
        }
        return view('expenses.bills',compact('suppliers','expenses','expense','categories'));
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

    public function report1(Request $request){
     

        $input = $request->all();
        $startdate =   date('Y-m-d',strtotime( $input['start']));
        $enddate =   date('Y-m-d',strtotime( $input['end']));
        $input['start'] = $startdate;
        $input['end'] = $enddate;
        return view('expenses.openreport',compact('input'));
    } 

    public function report($start,$end){
        

        $startdate =   date('Y-m-d',strtotime( $start));
        $enddate   =   date('Y-m-d',strtotime( $end));
        $expenses =  DB::table('expenses')
        ->leftJoin('expense_categories', 'expenses.category_id', '=', 'expense_categories.category_id')
        ->select(DB::raw('expenses.*, categoryname'))
        ->where('expense_date', '>=', $startdate)
        ->where('expense_date', '<=', $enddate)
        ->where('expenses.deleted_at', '=', NULL)
        ->get();

      
        $pdf = new MyPDF();
        $pdf-> SetWidths(7);
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',14);
       
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "Expenses between ". date('d-m-Y',strtotime($start)) . "  and ".date('d-m-Y',strtotime( $end)),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);
       
                //table header
        $pdf->SetFillColor(157, 245, 183);
        $pdf->setFont("times", "", "11");

      
        $pdf->Cell(105, 7, "EXPENSES", 1, 0, "C", 1);
        $pdf->SetFillColor(224, 235, 255);
        $pdf->Ln();
        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(30, 7, "Date", 1, 0, "C", 1);
        $pdf->Cell(75, 7, "Expense Category", 1, 0, "C", 1);
        $pdf->Cell(70, 7, "Narration", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "To", 1, 0, "C", 1);
       
        $pdf->Cell(40, 7, "Amount", 1, 0, "C", 1);
       
        $pdf->Ln();
        $counter = 1; 
        $y = $pdf->GetY();
        $x = 10;
        $fill = 0;

        

        $TOTALAMOUNT = 0 ;
foreach ($expenses as $expense){ 
    $TOTALAMOUNT += $expense->expense_amount;
    $pdf->Cell(20, 7,"TRX0".$expense ->expense_id, 1, 0, "L", $fill);
    $pdf->Cell(30, 7, date('d-m-Y',strtotime($expense ->expense_date)) , 1, 0, "L", $fill);
    $pdf->Cell(75, 7, $expense ->categoryname, 1, 0, "L", $fill);
    $pdf->Cell(70, 7, $expense ->narration, 1, 0, "L", $fill);
    $pdf->Cell(40, 7, $expense->supplier_id, 1, 0, "L", $fill);
   
    $pdf->Cell(40, 7, number_format($expense->expense_amount,2), 1, 0, "R", $fill);
   
    
    $counter++;
    
    $y += 7;
    $fill = !$fill;
    if ($y > 160) {
        $pdf->AddPage('L');
        $pdf->SetFillColor(157, 245, 183);
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 45);

        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(30, 7, "Date", 1, 0, "C", 1);
        $pdf->Cell(75, 7, "Expense Category", 1, 0, "C", 1);
        $pdf->Cell(70, 7, "Narration", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "To", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Amount", 1, 0, "C", 1);
       

        $pdf->Ln();
        $y = 52;
    }

    $pdf->Ln();
    $pdf->Cell(235, 7, "TOTAL EXPENSES", 1, 0, "R", $fill);
    $pdf->Cell(40, 7, number_format($TOTALAMOUNT,2), 1, 0, "R", $fill);

    $pdf->SetFillColor(224, 235, 255);
    $pdf->setXY($x, $y);
}
$pdf->Ln();

$pdf->Output("Expenses Report.pdf", "I");

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
        $input['expense_date']  =  date('Y-m-d', strtotime($input['expense_date']));
        Expenses::create($input);
        alert()->success('Success', 'Created Successfully');
      
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
        $expense = Expenses::find($id) ;
        $categories = ExpenseCategory::all() ;
        $expense->expense_date = date('m/d/Y', strtotime( $expense->expense_date));
        return view('expenses.editexpense',compact('expense','categories'));
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
        $expenses = Expenses::find($id) ;
        $input = $request->all();
        $input['expense_date']  =  date('Y-m-d', strtotime($input['expense_date']));
        $expenses ->expense_amount = $input['expense_amount'];
        $expenses ->category_id = $input['category_id'];
        $expenses ->narration = $input['narration'];
        $expenses ->paidto = $input['paidto'];
        $expenses ->trasnref = $input['trasnref']; 
        $expenses->save();
      
        return redirect()->action(
            'ExpensesController@index'
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
        Expenses::where('expense_id',$id)->delete();
        return back();
    }
}
