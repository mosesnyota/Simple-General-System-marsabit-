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
    
           $invoice_payments =   DB::select("SELECT YEAR(payment_date) AS expenyear , SUM(amount) AS total FROM invoice_payment
           WHERE deleted_at IS NULL AND YEAR(payment_date)  >= (YEAR(CURDATE()) - 3) GROUP BY expenyear");
    
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
                if( $year0 == $totald->expenyear){
                    $totalIncomethisYear = $totald->total;
                }
    
                if( $year1 == $totald->expenyear){
                    $incomeLastYear = $totald->total;
                }
              
                
                $incomePerYear[$totald->expenyear] = $totald->total;
            }
            
    
    
            //PROCESS FEE PAYMENTS FOR THE YEARS
           $feepayments =   DB::select('SELECT YEAR(payment_date) AS payyear, SUM(amount) AS total FROM fee_payments
           WHERE deleted_at IS NULL AND YEAR(payment_date) >= (YEAR(CURDATE()) - 3) GROUP BY payyear ');
    
            $feesPerYears = [];
            $totalFee = 0 ;
            $feeThisYear = 0;
            $feeLastYear = 0;
    
            foreach ($feepayments as $totald){ 
                
    
                if( $year0 == $totald->payyear){
                    $totalFee = $totald->total;
                }
    
                if( $year1 == $totald->payyear){
                    $feeLastYear  = $totald->total;
                }
                $incomePerYear[$totald->payyear] = $incomePerYear[$totald->payyear] + $totald->total;
            }
    
           
             if($feeLastYear == 0){
                $feePercent = 100;
             }else{
                $feePercent = (($feeThisYear - $feeLastYear)/$feeLastYear ) * 100;
             }
            
            
            if($incomeLastYear == 0){
                $percentage = 100;
            }else{
                $percentage = (($totalIncomethisYear - $incomeLastYear)/$incomeLastYear ) * 100;
            }
            
    
            $activestudents =  DB::table('students')
            ->select(DB::raw('count(*) AS total'))
            ->where('cur_status', '=', 'active')
            ->where('deleted_at', '=', NULL)
            ->get();
    
            $totalStudents = 0 ;
            foreach ($activestudents as $totald){ 
                $totalStudents = $totald->total;
            }
    
            
           
    
            $activestudentsGender =  DB::table('students')
            ->select(DB::raw('gender, count(gender) AS total'))
            ->where('cur_status', '=', 'active')
            ->where('deleted_at', '=', NULL)
            ->groupBy('gender')
            ->get();
    
            $male = 0 ;
            $female = 0 ;
            foreach ($activestudentsGender as $totald){ 
               
                if( $totald->gender == 'Male'){
                    $male = $totald->total; ;
                }else{
                    $female = $totald->total;
                }
               
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
            $studentDetails['male'] =  $male;
            $studentDetails['female'] = $female;
            $studentDetails['totalFees'] = $feeThisYear;
            $studentDetails['feePercent'] =  $feePercent;
            $studentDetails['totalInvoices'] =  $totalInvoices;
    
    
    
    
            //SECTION TO GET EXPENSES
            $expense = array();
    
            $expenseFor4Years = DB::SELECT("SELECT YEAR(`expense_date`) AS expenyear, SUM(`expense_amount`) AS total FROM `expenses`
            WHERE YEAR(`expense_date`) >= (YEAR(CURDATE()) - 3) and deleted_at is null  GROUP BY expenyear");
            $expensesPerYear = [];
            $expensesPerYear[ $year0] = 0;
            $expensesPerYear[ $year1] = 0;
            $expensesPerYear[ $year2] = 0;
            $expensesPerYear[ $year3] = 0;
    
            $expense['thisyear'] =  0;
            $expense['expelastyear'] =  0;
    
            foreach( $expenseFor4Years as $expeY4){
                $expensesPerYear[$expeY4 ->expenyear ] =  $expeY4->total;
                if( $year0 == $expeY4->expenyear){
                    $expense['thisyear']  = $expeY4->total;
                }
                if( $year1 == $expeY4->expenyear){
                    $expense['expelastyear']  = $expeY4->total;
                }
    
            }
    
    
            $pettyCashExpenses = DB::select("SELECT YEAR(`transaction_date`) AS expenyear, SUM(amount) AS total FROM `petty_cashes`
            WHERE `transactiontype` = 'Withdraw' AND deleted_at IS NULL AND YEAR(transaction_date) >= (YEAR(CURDATE()) - 3) GROUP BY expenyear ");
            
            foreach( $pettyCashExpenses as $expeY4){
                $expensesPerYear[$expeY4 ->expenyear ] = $expensesPerYear[$expeY4 ->expenyear ] + $expeY4->total;
                if( $year0 == $expeY4->expenyear){
                    $expense['thisyear']  = $expense['thisyear'] + $expeY4->total;
                }
                if( $year1 == $expeY4->expenyear){
                    $expense['expelastyear']  = $expense['expelastyear'] + $expeY4->total;
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
            JOIN `customers` ON invoices.`customer_id` = `customers`.`customer_id` 
            WHERE invoices.deleted_at is null and invoice_payment.deleted_at is null order by payment_date desc LIMIT 5");
    
    
            
            return view('home', compact('totalFee','payments','paymentsInvoice','totalIncomethisYear','totalStudents','percentage',
                  'studentDetails','expense','pecentChange','incomePerYear','expensesPerYear'));
        
        

        $paymentsInvoice = DB::select("SELECT `invoice_payment`.*, `customer_names`, `narration` FROM `invoice_payment`
        JOIN `invoices` ON invoices.`invoice_id` = invoice_payment.`invoice_id`
        JOIN `customers` ON invoices.`customer_id` = `customers`.`customer_id` order by payment_date desc LIMIT 5");





    }
//END OF FUNCTION INDEX








    public function test()
    {
        return view('testhome');
    }

    
    
    
}
