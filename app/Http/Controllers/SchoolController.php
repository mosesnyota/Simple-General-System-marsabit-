<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\FeePayment;

class SchoolController extends Controller
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
        $students  = DB::select( DB::raw("SELECT A.*,course_name ,
        ((SELECT COALESCE(SUM(fees_invoice.amount),0) FROM `fees_invoice` WHERE fees_invoice.`student_id` = A.student_id and fees_invoice.deleted_at is null)
        -
        (SELECT COALESCE(SUM(fee_payments.amount) , 0) FROM `fee_payments` WHERE fee_payments.`student_id` = A.student_id and fee_payments.deleted_at is null )) AS balance
        FROM students A   left join courses B on A.course_id = B.course_id
        WHERE A.`cur_status` = 'Active' 
        GROUP BY A.student_id") );



        $activestudents =  DB::table('students')
        ->select(DB::raw('count(*) AS total'))
        ->where('cur_status', '=', 'active')
        ->where('deleted_at', '=', NULL)
        ->get();

        $totalopen = 0 ;
        foreach ($activestudents as $totald){ 
            $totalopen = $totald->total;
        }

        
        $payments =  DB::table('fee_payments')
        ->join('students', 'fee_payments.student_id', '=', 'students.student_id')
        ->select(DB::raw('fee_payments.*,first_name,middle_name,surname'))
        ->where('fee_payments.deleted_at', '=', NULL)
        ->orderBy('payment_date','DESC')
        ->limit(5)
        ->get();

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

        $studentDetails = [];
        $studentDetails['male'] =  $male;
        $studentDetails['female'] = $female;
        $studentDetails['totalopen'] = $totalopen;

        $feepaid = DB::SELECT('SELECT SUM(`amount`) AS total FROM `fee_payments` WHERE YEAR(`payment_date`) = YEAR(CURDATE())');
        $totalFeePaid = 0 ;
        foreach($feepaid as $paid){
            $totalFeePaid = $paid -> total;
        }

        $totalinvoices1 = 0;
        $totalpayments1 = 0;
        $totalinvoices =  DB::select( DB::raw("SELECT students.`student_id`,`student_no`,`first_name`,`middle_name`,
        `surname`,`cur_status`,comment, SUM(amount) AS invoiced FROM `students`
        JOIN `fees_invoice` ON `students`.`student_id` = `fees_invoice`.`student_id`
        GROUP BY student_id  HAVING invoiced > 0"));

        foreach($totalinvoices as $invoice){ 
            $totalinvoices1 += $invoice ->invoiced;

        }
        $totalpayments =  DB::select( DB::raw("SELECT `student_id`, SUM(amount) AS paid FROM `fee_payments`
        GROUP BY student_id   "));

        foreach($totalpayments as $payments2){ 
            $totalpayments1 += $payments2 ->paid;

        }

        $unpaidfees = $totalinvoices1 - $totalpayments1;
        



        $studentDetails['paid'] = $totalFeePaid;
        $studentDetails['unpaid'] = $unpaidfees;
        
        return view('school.index',compact('students','studentDetails','payments'));
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
        //
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
        //
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
