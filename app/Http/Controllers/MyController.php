<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Sponsor;
use App\Project;
use App\Votehead;
use DB;
use App\Student;
use App\FeePayment;
use PDF;


use App\StudentNumber;


class MyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $year0 = date('Y');
        $year1 = date('Y') - 1;
        $year2 = date('Y') - 2;
        $year3 = date('Y') - 3;

  
        $invoice_payments =   DB::select("SELECT `YearID` as expenyear, SUM(`Amount_LC`) AS total
        FROM
    `tech_epr`.`voucherdetail`
    INNER JOIN `tech_epr`.`voucher` 
        ON (`voucherdetail`.`VoucherID` = `voucher`.`VoucherID`)
    INNER JOIN `tech_epr`.`ledger` 
        ON (`voucherdetail`.`LedgerID` = `ledger`.`LedgerID`)
    INNER JOIN `tech_epr`.`costcentre` 
        ON (`voucherdetail`.`CostCentreID` = `costcentre`.`CostCentreID`)
                WHERE VoucherType = 'RC'  AND YearID  >= (YEAR(CURDATE()) - 3)
                and isbank = 0 AND category = 'Educational Income'
                AND  ledgerhead NOT IN ('Depreciation expense')
                    AND VoucherType != 'OP' AND MODE = -1 
                GROUP BY YearID");



        $totalIncomethisYear = 0 ;
        $feeLastYear  = 0 ;

        //Declare array, initialize years with values to avoid 
        //array out of bound error
        $incomePerYear = [];
        $incomePerYear[$year0] =  0 ;
        $incomePerYear[$year1] =  0 ;
        $incomePerYear[$year2] =  0 ;
        $incomePerYear[$year3] =  0 ;

        $incomeLastYear = 0  ;
        foreach ($invoice_payments as $totald){ 
            if( $year1 == $totald->expenyear){
                $totalIncomethisYear = $totald->total;
            }

            if( $year2 == $totald->expenyear){
                $incomeLastYear = $totald->total;
            }
          
            
            $incomePerYear[$totald->expenyear] = $totald->total;
        }
        

        
      


        $activeInvoices =  DB::table('invoices')
        ->select(DB::raw('count(*) AS total'))
        ->where('cur_status' ,'!=','paid')
        ->where('deleted_at' ,'=',null)
        ->get();


        $totalInvoices = 0 ;
        foreach ($activeInvoices as $totald){ 
            $totalInvoices = $totald->total;
        }

        $studentDetails = [];
        $studentDetails['male'] =  StudentNumber::find(1)->std_num;
        $studentDetails['female'] = 0;
        $studentDetails['totalFees'] = 40;
        $studentDetails['feePercent'] =  10;
        $studentDetails['totalInvoices'] =  $totalInvoices;


        $percentage = 100;
        $totalStudents = $studentDetails['male']  ;
        $totalFee = 0 ;

        //SECTION TO GET EXPENSES
        $expense = array();

        // $expenseFor4Years = DB::SELECT("SELECT YEAR(`expense_date`) AS expenyear, SUM(`expense_amount`) AS total FROM `expenses`
        // WHERE YEAR(`expense_date`) >= (YEAR(CURDATE()) - 3) GROUP BY expenyear");

        $expenseFor4Years = DB::SELECT("SELECT `YearID` as expenyear, SUM(`Amount_LC`) AS total
        FROM
    `tech_epr`.`voucherdetail`
    INNER JOIN `tech_epr`.`voucher` 
        ON (`voucherdetail`.`VoucherID` = `voucher`.`VoucherID`)
    INNER JOIN `tech_epr`.`ledger` 
        ON (`voucherdetail`.`LedgerID` = `ledger`.`LedgerID`)
    INNER JOIN `tech_epr`.`costcentre` 
        ON (`voucherdetail`.`CostCentreID` = `costcentre`.`CostCentreID`)
                WHERE VoucherType = 'PY'  AND YearID  >= (YEAR(CURDATE()) - 3)
                and isbank = 0 AND category = 'Educational Expenses'
                AND  ledgerhead NOT IN ('Depreciation expense')
                    AND VoucherType != 'OP' AND MODE = 1 
                GROUP BY YearID");


        $expensesPerYear = [];
        $expensesPerYear[ $year0] = 0;
        $expensesPerYear[ $year1] = 0;
        $expensesPerYear[ $year2] = 0;
        $expensesPerYear[ $year3] = 0;

        $expense['thisyear'] =  1;
        $expense['expelastyear'] =  0;

        foreach( $expenseFor4Years as $expeY4){
            $expensesPerYear[$expeY4 ->expenyear ] =  $expeY4->total;
            if( $year1 == $expeY4->expenyear){
                $expense['thisyear']  = $expeY4->total;
            }
            if( $year2 == $expeY4->expenyear){
                $expense['expelastyear']  = $expeY4->total;
            }

        }


        


        $pecentChange = 0;
        if($expense['expelastyear'] == 0){
            $pecentChange = 100  ;
        }else{
            $pecentChange = (($expense['thisyear'] - $expense['expelastyear']) /  $expense['expelastyear'] ) * 100;

        }

    
        $payments =  DB::table('fee_payments')
        ->join('students', 'fee_payments.student_id', '=', 'students.student_id')
        ->select(DB::raw('fee_payments.*,first_name,middle_name,surname'))
        ->where('fee_payments.deleted_at', '=', NULL)
        ->orderBy('payment_date','DESC')
        ->limit(5)
        ->get();





        

        $paymentsInvoice = DB::select("SELECT `invoice_payment`.*, `customer_names`, `narration` FROM `invoice_payment`
        JOIN `invoices` ON invoices.`invoice_id` = invoice_payment.`invoice_id`
        JOIN `customers` ON invoices.`customer_id` = `customers`.`customer_id` order by payment_date desc LIMIT 5");


        
        return view('home', compact('totalFee','payments','paymentsInvoice','totalIncomethisYear','totalStudents','percentage',
              'studentDetails','expense','pecentChange','incomePerYear','expensesPerYear'));
    }
//END OF FUNCTION INDEX








    public function test()
    {
        return view('testhome');
    }

    
    
    
}
