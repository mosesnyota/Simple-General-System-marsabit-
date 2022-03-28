<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\FeePayment;
use App\Course;

use App\MyPDF;
use App\MyPDFPortrait;

class SchoolController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $students  = DB::select( DB::raw( "SELECT A.*,course_name ,
        ((SELECT COALESCE(SUM(fees_invoice.amount),0) FROM `fees_invoice` WHERE fees_invoice.`student_id` = A.student_id and fees_invoice.deleted_at is null)
        -
        (SELECT COALESCE(SUM(fee_payments.amount) , 0) FROM `fee_payments` WHERE fee_payments.`student_id` = A.student_id and fee_payments.deleted_at is null )) AS balance
        FROM students A   left join courses B on A.course_id = B.course_id
        WHERE A.`cur_status` = 'Active' 
        GROUP BY A.student_id" ) );

        $activestudents =  DB::table( 'students' )
        ->select( DB::raw( 'count(*) AS total' ) )
        ->where( 'cur_status', '=', 'active' )
        ->where( 'deleted_at', '=', NULL )
        ->get();

        $totalopen = 0 ;
        foreach ( $activestudents as $totald ) {

            $totalopen = $totald->total;
        }

        $payments =  DB::table( 'fee_payments' )
        ->join( 'students', 'fee_payments.student_id', '=', 'students.student_id' )
        ->select( DB::raw( 'fee_payments.*,first_name,middle_name,surname' ) )
        ->where( 'fee_payments.deleted_at', '=', NULL )
        ->orderBy( 'payment_date', 'DESC' )
        ->limit( 5 )
        ->get();

        $activestudentsGender =  DB::table( 'students' )
        ->select( DB::raw( 'gender, count(gender) AS total' ) )
        ->where( 'cur_status', '=', 'active' )
        ->where( 'deleted_at', '=', NULL )
        ->groupBy( 'gender' )
        ->get();

        $male = 0 ;
        $female = 0 ;
        foreach ( $activestudentsGender as $totald ) {

            if ( $totald->gender == 'Male' ) {
                $male = $totald->total;
                ;
            } else {
                $female = $totald->total;
            }

        }

        $studentDetails = [];
        $studentDetails[ 'male' ] =  $male;
        $studentDetails[ 'female' ] = $female;
        $studentDetails[ 'totalopen' ] = $totalopen;

        $feepaid = DB::SELECT( 'SELECT SUM(`amount`) AS total FROM `fee_payments` WHERE YEAR(`payment_date`) = YEAR(CURDATE())' );
        $totalFeePaid = 0 ;
        foreach ( $feepaid as $paid ) {
            $totalFeePaid = $paid -> total;
        }

        $totalinvoices1 = 0;
        $totalpayments1 = 0;
        $totalinvoices =  DB::select( DB::raw( "SELECT students.`student_id`,`student_no`,`first_name`,`middle_name`,
        `surname`,`cur_status`,comment, SUM(amount) AS invoiced FROM `students`
        JOIN `fees_invoice` ON `students`.`student_id` = `fees_invoice`.`student_id`
        GROUP BY student_id  HAVING invoiced > 0" ) );

        foreach ( $totalinvoices as $invoice ) {

            $totalinvoices1 += $invoice ->invoiced;

        }
        $totalpayments =  DB::select( DB::raw( "SELECT `student_id`, SUM(amount) AS paid FROM `fee_payments`
        GROUP BY student_id   " ) );

        foreach ( $totalpayments as $payments2 ) {

            $totalpayments1 += $payments2 ->paid;

        }

        $unpaidfees = $totalinvoices1 - $totalpayments1;

        $studentDetails[ 'paid' ] = $totalFeePaid;
        $studentDetails[ 'unpaid' ] = $unpaidfees;

        $courses = Course::all();

        return view( 'school.index', compact( 'students', 'studentDetails', 'courses', 'payments' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function printclasslist(Request $request){
        $input = $request->all();
        $id = $input['course_id'];
        $course = Course::find($id);
            $pdf = new MyPDFPortrait();
            $pdf-> SetWidths( 7 );
            $pdf->AddPage();
            $pdf->SetFont( 'Times', '', 11 );
    
            //Table with 20 rows and 4 columns
            $pdf->SetX( 5 );
            $pdf->SetFillColor( 237, 228, 226 );
            $pdf->Ln( 7 );
            $pdf-> Cell( 190, 10, 'Active Students in '. $course->course_name . " as at date : ".   date( 'd-m-Y h:i:sa' ), 0, 0, 'C', 1, '' );
            $pdf->Ln( 15 );
            $pdf->SetX( 10 );
    
            $pdf->SetFont( 'Times', '', 11 );
    
            //table header
            $pdf->SetFillColor( 157, 245, 183 );
            $pdf->setFont( 'times', '', '11' );
    
            $pdf->Cell( 105, 7, $course->course_name, 1, 0, 'C', 1 );
            $pdf->SetFillColor( 224, 235, 255 );
            $pdf->Ln();
            $pdf->Cell( 10, 7, '#', 1, 0, 'L', 1 );
            $pdf->Cell( 30, 7, 'Admn', 1, 0, 'C', 1 );
            $pdf->Cell( 70, 7, 'Name', 1, 0, 'C', 1 );
            $pdf->Cell( 40, 7, 'Status', 1, 0, 'C', 1 );
            $pdf->Cell( 30, 7, 'Balance', 1, 0, 'C', 1 );
    
            $pdf->Ln();
            $counter = 1;
    
            $y = $pdf->GetY();
            $x = 10;
            $fill = 0;
    
            $pdf->SetWidths( array( 10, 30, 70, 40, 30 ) );
            $aligns = array( 'R', 'C', 'L', 'L', 'R' );
            $pdf->SetAligns( $aligns );
            $pdf->SetFillColor( 224, 235, 255 );
    
            $invoices =  DB::select( DB::raw( "SELECT students.`student_id`,`student_no`,`first_name`,`middle_name`,
            `surname`,`cur_status`,comment, SUM(amount) AS invoice FROM `students`
            JOIN `fees_invoice` ON `students`.`student_id` = `fees_invoice`.`student_id`
            where fees_invoice.deleted_at is null and students.deleted_at is null
            AND students.course_id = $id
            GROUP BY student_id  HAVING invoice > 0" ) );
    
            $payments =  DB::select( DB::raw( "SELECT `student_id`, SUM(amount) AS paid FROM `fee_payments`
            where fee_payments.deleted_at is null GROUP BY student_id  " ) );
    
            $totalbalance = 0 ;
            foreach ( $invoices as $invoice ) {
    
                $paid = 0 ;
                $bal = 0 ;
                $id =  $invoice->student_id;
                foreach ( $payments as $payment ) {
    
                    if ( $payment->student_id == $id ) {
                        $paid = $payment->paid;
                    }
                }
    
                $bal = $invoice ->invoice - $paid ;
                $fill =  !$fill;
                $type = '';
    
                
                    $totalbalance += $invoice ->invoice - $paid;
                    $pdf->Row( array(
                        $counter,
                        $invoice->student_no,
                        $invoice->first_name.' '.$invoice->middle_name.' '. $invoice->surname,
                        $invoice->cur_status.'/'.$invoice->comment,
                        number_format( ( $invoice ->invoice - $paid ), 2 )
                    ), $fill );
    
                    $counter++;
                
            }
    
            $pdf->Cell( 110, 7, 'Total Balance ', 1, 0, 'R', $fill );
            $pdf->Cell( 70, 7, number_format( $totalbalance, 2 ), 1, 0, 'R', $fill );
    
            $pdf->Ln();
    
            $pdf->SetFillColor( 224, 235, 255 );
            $pdf->setXY( $x, $y );
            $pdf->Output( 'Students NO balance.pdf', 'I' );
    
            exit;
        
    }
    public function store( Request $request ) {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }

    public function smscomm() {
        return view( 'school.smsindex' );
    }
}
