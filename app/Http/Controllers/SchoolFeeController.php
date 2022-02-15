<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\FeeInvoice;
use App\FeeVotehead;
use App\Course;
use SweetAlert;
use App\Student;
use App\FeePayment;
use Illuminate\Support\Facades\Auth;
use App\PettyCashReceipt;

use App\MyPDF;
use App\MyPDFPortrait;

class SchoolFeeController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $voteheads = FeeVotehead::all();
        $students  = DB::select( DB::raw( "SELECT A.*,course_name as department,
        ((SELECT COALESCE(SUM(fees_invoice.amount),0) FROM `fees_invoice` WHERE fees_invoice.`student_id` = A.student_id and fees_invoice.deleted_at is null)
        -
        (SELECT COALESCE(SUM(fee_payments.amount) , 0) FROM `fee_payments` WHERE fee_payments.`student_id` = A.student_id and fee_payments.deleted_at is null )) AS balance
        FROM students A   join courses B on A.course_id = B.course_id
        WHERE A.`cur_status` = 'Active'
        GROUP BY A.student_id" ) );

        return view( 'fee.index', compact( 'students', 'voteheads' ) );

    }

    public function feebalances() {

        $pdf = new MyPDFPortrait();
        $pdf-> SetWidths( 7 );
        $pdf->AddPage();
        $pdf->SetFont( 'Times', '', 11 );

        //Table with 20 rows and 4 columns
        $pdf->SetX( 5 );
        $pdf->SetFillColor( 237, 228, 226 );
        $pdf->Ln( 7 );
        $pdf-> Cell( 190, 10, ' FEE BALANCES '.   date( 'd-m-Y h:i:sa' ), 0, 0, 'C', 1, '' );
        $pdf->Ln( 15 );
        $pdf->SetX( 10 );

        $pdf->SetFont( 'Times', '', 11 );

        //table header
        $pdf->SetFillColor( 157, 245, 183 );
        $pdf->setFont( 'times', '', '11' );

        $pdf->Cell( 105, 7, 'FEE BALANCES', 1, 0, 'C', 1 );
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

            if ( $bal > 0 ) {
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
        }

        $pdf->Cell( 110, 7, 'Total Balance ', 1, 0, 'R', $fill );
        $pdf->Cell( 70, 7, number_format( $totalbalance, 2 ), 1, 0, 'R', $fill );

        $pdf->Ln();

        $pdf->SetFillColor( 224, 235, 255 );
        $pdf->setXY( $x, $y );
        $pdf->Output( 'Students Balances.pdf', 'I' );

        exit;
    }


    public function zeroBalances() {

        $pdf = new MyPDFPortrait();
        $pdf-> SetWidths( 7 );
        $pdf->AddPage();
        $pdf->SetFont( 'Times', '', 11 );

        //Table with 20 rows and 4 columns
        $pdf->SetX( 5 );
        $pdf->SetFillColor( 237, 228, 226 );
        $pdf->Ln( 7 );
        $pdf-> Cell( 190, 10, ' STUDENTS WITH OVERPAYMENTS AND ZERO FEE BALANCES '.   date( 'd-m-Y h:i:sa' ), 0, 0, 'C', 1, '' );
        $pdf->Ln( 15 );
        $pdf->SetX( 10 );

        $pdf->SetFont( 'Times', '', 11 );

        //table header
        $pdf->SetFillColor( 157, 245, 183 );
        $pdf->setFont( 'times', '', '11' );

        $pdf->Cell( 105, 7, 'NO BALANCES', 1, 0, 'C', 1 );
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

            if ( $bal <= 0 ) {
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
        }

        $pdf->Cell( 110, 7, 'Total Balance ', 1, 0, 'R', $fill );
        $pdf->Cell( 70, 7, number_format( $totalbalance, 2 ), 1, 0, 'R', $fill );

        $pdf->Ln();

        $pdf->SetFillColor( 224, 235, 255 );
        $pdf->setXY( $x, $y );
        $pdf->Output( 'Students NO balance.pdf', 'I' );

        exit;
    }

   


    public function editreceipt( $id ) {
        $payments =  DB::table( 'fee_payments' )
        ->join( 'students', 'fee_payments.student_id', '=', 'students.student_id' )
        ->select( DB::raw( 'fee_payments.*,first_name,middle_name,surname,student_no' ) )
        ->where( 'fee_payments.deleted_at', '=', NULL )
        ->where( 'fee_payments.payment_id', '=', $id )
        ->get();

        $payment = null;
        foreach ( $payments  as $py ) {
            $payment = $py;
        }

        return view( 'fee.editreceipt', compact( 'payment' ) );

    }

    public function addfeeinvoice( Request $request, $id ) {
        $inputs = $request->all();

        $inputs[ 'student_id' ] = $id;
        $inputs[ 'course_id' ] = Student::find( $id )->course_id;

        FeeInvoice::create( $inputs )->fee_invoice_id;
        return redirect()->action(
            'SchoolFeeController@viewstatement', $id
        );

    }

    public function printStatement( $student_id, $year, $term ) {
        //schoolfees/6/viewinvoices/2021/Term%201/printstatement
        $id = $student_id;
        $PYS =  DB::select( "SELECT CONCAT(first_name,' ',middle_name,
        '  Admn: ',student_no) AS studentname from students WHERE  student_id = '$student_id' " );

        $pt = null;
        foreach ( $PYS  as $py ) {
            $pt = $py;
        }
        $studentname = $pt->studentname;

        $payments =  DB::select( DB::raw( " SELECT `votehead`, fees_invoice.created_at as payment_date ,  `fee_invoice_id`,`term`,`inv_year`,`fees_invoice`.`amount`   FROM `fees_invoice`
        JOIN `fees_voteheads` ON `fees_invoice`.`votehead_id` = `fees_voteheads`.`votehead_id` WHERE student_id = $student_id 
        and term = '$term' and inv_year = '$year'" ) );

        $term = 0;
        $year = 0;
        $termyear = '';
        foreach ( $payments  as $pd ) {
            $term = $pd -> term;
            $year = $pd -> inv_year;

        }
        $termyear = $term.'  '.$year;
        $voteheads  = FeeVotehead::all();

        $billed  = DB::select( DB::raw( " SELECT SUM( IFNULL(`amount`,0)) AS billed FROM students LEFT JOIN `fees_invoice`
        ON students.`student_id` = fees_invoice.`student_id`  WHERE students.student_id = $id " ) );
        $bill = 0 ;

        foreach ( $billed as $bld ) {

            $bill = $bld-> billed;
        }

        $paidld  = DB::select( DB::raw( " SELECT  SUM( IFNULL(`amount`,0)) AS paid FROM  
        students LEFT JOIN `fee_payments`
        ON students.`student_id` = fee_payments.`student_id` WHERE students.student_id = $id  AND fee_payments.deleted_at IS NULL" ) );
        $paid = 0 ;

        foreach ( $paidld as $pdd ) {

            $paid = $pdd-> paid;
        }

        $balance =  $bill  - $paid;

        $pdf = new MyPDFPortrait();
        $pdf-> SetWidths( 7 );
        $pdf->AddPage();
        $pdf->SetFont( 'Times', '', 11 );

        //Table with 20 rows and 4 columns
        $pdf->SetX( 5 );
        $pdf->SetFillColor( 237, 228, 226 );
        $pdf->Ln( 7 );
        $pdf-> Cell( 190, 10, 'FEE INVOICE '. $termyear . ' FOR : '.strtoupper( $studentname ).'        Printed On :'.   date( 'd-m-Y h:i:sa' ), 0, 0, 'C', 1, '' );
        $pdf->Ln( 15 );
        $pdf->SetX( 10 );
        $pdf->SetFont( 'Times', '', 11 );

        //table header
        $pdf->SetFillColor( 157, 245, 183 );
        $pdf->setFont( 'times', '', '11' );

        $pdf->Cell( 105, 7, 'FEE STATEMENT', 1, 0, 'C', 1 );
        $pdf->SetFillColor( 224, 235, 255 );
        $pdf->Ln();
        $pdf->Cell( 20, 7, '#', 1, 0, 'L', 1 );
        $pdf->Cell( 85, 7, 'Votehead', 1, 0, 'C', 1 );
        $pdf->Cell( 70, 7, 'Amount', 1, 0, 'C', 1 );

        $pdf->Ln();
        $counter = 1;

        $y = $pdf->GetY();
        $x = 10;
        $fill = 0;

        $pdf->SetWidths( array( 20, 85, 70 ) );
        $aligns = array( 'L', 'L', 'R' );
        $pdf->SetAligns( $aligns );
        $pdf->SetFillColor( 224, 235, 255 );

        $TOTALAMOUNT = 0 ;
        foreach ( $payments as $payment ) {

            $fill =  !$fill;
            $type = '';
            $TOTALAMOUNT += $payment ->amount;
            $pdf->Row( array(
                $counter,
                $payment->votehead,
                number_format( $payment ->amount, 2 )
            ), $fill );

            $counter++;
        }

        $pdf->Cell( 105, 7, 'Total for the term ', 1, 0, 'R', $fill );
        $pdf->Cell( 70, 7, number_format( $TOTALAMOUNT, 2 ), 1, 0, 'R', $fill );

        $pdf->Ln();

        $pdf->Cell( 105, 7, '', 1, 0, 'R', $fill );
        $pdf->Cell( 70, 7, '', 1, 0, 'R', $fill );
        $pdf->Ln();

        $pdf->Cell( 105, 7, 'Current Balance [ This includes previous balances/over payments', 1, 0, 'R', $fill );
        $pdf->Cell( 70, 7, number_format( $balance, 2 ), 1, 0, 'R', $fill );

        $pdf->SetFillColor( 224, 235, 255 );
        $pdf->setXY( $x, $y );
        $pdf->Output( 'Fee Invoice.pdf', 'I' );

        exit;

    }

    public function printfeestatement( $id ) {
        $PYS =  DB::select( "SELECT CONCAT(first_name,' ',middle_name,
        '  Admn: ',student_no) AS studentname from students WHERE  student_id = '$id' " );

        $pt = null;
        foreach ( $PYS  as $py ) {
            $pt = $py;
        }
        $studentname = $pt->studentname;

        $payments =  DB::select( "SELECT * FROM ( 
            SELECT 'Payment' AS paytype,student_no,students.student_id,payment_date
            ,SUM(amount) AS total,'-' AS term, '-' AS inv_year
            FROM fee_payments
            JOIN students ON students.student_id = fee_payments.student_id
            WHERE students.deleted_at IS NULL AND fee_payments.deleted_at IS NULL 
            AND fee_payments.student_id = $id GROUP BY payment_date
            UNION
            SELECT 'Invoice' AS paytype ,student_no, students.student_id,  '-' AS payment_date
             , SUM(amount) AS total,  `term`,`inv_year`
            FROM fees_invoice 
            JOIN students ON students.student_id = fees_invoice.student_id
            WHERE students.deleted_at IS NULL AND fees_invoice.deleted_at IS NULL 
            AND fees_invoice.student_id = $id
            GROUP BY inv_year, term
            ) AS A
            ORDER BY A.payment_date" );

        $billed  = DB::select( DB::raw( " SELECT SUM( IFNULL(`amount`,0)) AS billed FROM students LEFT JOIN `fees_invoice`
        ON students.`student_id` = fees_invoice.`student_id`  WHERE students.student_id = $id " ) );
        $bill = 0 ;

        foreach ( $billed as $bld ) {

            $bill = $bld-> billed;
        }

        $paidld  = DB::select( DB::raw( " SELECT  SUM( IFNULL(`amount`,0)) AS paid FROM  
        students LEFT JOIN `fee_payments`
        ON students.`student_id` = fee_payments.`student_id` WHERE students.student_id = $id  AND fee_payments.deleted_at IS NULL" ) );
        $paid = 0 ;

        foreach ( $paidld as $pdd ) {

            $paid = $pdd-> paid;
        }

        $balance =  $bill  - $paid;

        $pdf = new MyPDFPortrait();
        $pdf-> SetWidths( 7 );
        $pdf->AddPage();
        $pdf->SetFont( 'Times', '', 11 );

        //Table with 20 rows and 4 columns
        $pdf->SetX( 5 );
        $pdf->SetFillColor( 237, 228, 226 );
        $pdf->Ln( 7 );
        $pdf-> Cell( 190, 10, 'FEE STATEMENT FOR : '.strtoupper( $studentname ).' as at : '.   date( 'd-m-Y h:i:sa' ), 0, 0, 'C', 1, '' );
        $pdf->Ln( 15 );
        $pdf->SetX( 10 );
        $pdf->SetFont( 'Times', '', 11 );

        //table header
        $pdf->SetFillColor( 157, 245, 183 );
        $pdf->setFont( 'times', '', '11' );

        $pdf->Cell( 105, 7, 'FEE STATEMENT', 1, 0, 'C', 1 );
        $pdf->SetFillColor( 224, 235, 255 );
        $pdf->Ln();
        $pdf->Cell( 20, 7, '#', 1, 0, 'L', 1 );
        $pdf->Cell( 50, 7, 'Type', 1, 0, 'C', 1 );
        $pdf->Cell( 70, 7, 'Narration', 1, 0, 'C', 1 );
        $pdf->Cell( 50, 7, 'Amount', 1, 0, 'C', 1 );

        $pdf->Ln();
        $counter = 1;

        $y = $pdf->GetY();
        $x = 10;
        $fill = 0;

        $pdf->SetWidths( array( 20, 50, 70, 50 ) );
        $aligns = array( 'L', 'L', 'L', 'R' );
        $pdf->SetAligns( $aligns );
        $pdf->SetFillColor( 224, 235, 255 );

        $TOTALAMOUNT = 0 ;
        foreach ( $payments as $payment ) {

            $fill =  !$fill;
            $type = '';
            if ( $payment ->paytype == 'Invoice' )
            $type = 'Fee Invoice : '.$payment->term.' '.$payment->inv_year;
            else {
                $type = date_format( date_create( $payment->payment_date ), 'd-m-Y' );
            }

            $pdf->Row( array(
                $counter,
                $payment->paytype, $type,
                number_format( $payment ->total, 2 )
            ), $fill );

            $counter++;
        }

        $pdf->Cell( 120, 7, 'TOTAL BALANCE', 1, 0, 'R', $fill );
        $pdf->Cell( 70, 7, number_format( $balance, 2 ), 1, 0, 'R', $fill );

        $pdf->SetFillColor( 224, 235, 255 );
        $pdf->setXY( $x, $y );
        $pdf->Output( 'Expenses Report.pdf', 'I' );

        exit;

    }

    public function viewstatement( $id ) {
        $PYS =  DB::select( "SELECT CONCAT(first_name,' ',middle_name,
        '  Admn: ',student_no) AS studentname from students WHERE  student_id = '$id' " );

        $pt = null;
        foreach ( $PYS  as $py ) {
            $pt = $py;
        }
        $studentname = $pt->studentname;

        $payments =  DB::select( "SELECT * FROM (
            SELECT 'Payment' AS paytype,student_no,students.student_id,payment_date
            ,SUM(amount) AS total,'-' AS term, '-' AS inv_year
            FROM fee_payments
            JOIN students ON students.student_id = fee_payments.student_id
            WHERE students.deleted_at IS NULL AND fee_payments.deleted_at IS NULL 
            AND fee_payments.student_id = $id GROUP BY payment_date
            UNION
            SELECT 'Invoice' AS paytype ,student_no, students.student_id,  '-' AS payment_date
             , SUM(amount) AS total,  `term`,`inv_year`
            FROM fees_invoice 
            JOIN students ON students.student_id = fees_invoice.student_id
            WHERE students.deleted_at IS NULL AND fees_invoice.deleted_at IS NULL 
            AND fees_invoice.student_id = $id
            GROUP BY inv_year, term
            ) AS A
            ORDER BY A.payment_date" );

        $voteheads  = FeeVotehead::all();
        return view( 'fee.feestatement', compact( 'payments', 'studentname', 'voteheads' ) );
    }

    public function viewinvoices( $student_id, $year, $term ) {

        $PYS =  DB::table( 'students' )
        ->select( DB::RAW( "CONCAT(first_name,' ',middle_name) AS studentname" ) )
        ->where( 'students.student_id', '=', $student_id )
        ->get();

        $pt = null;
        foreach ( $PYS  as $py ) {
            $pt = $py;
        }
        $studentname = $pt->studentname;

        $payments =  DB::select( DB::raw( " SELECT `votehead`, fees_invoice.created_at as payment_date ,  `fee_invoice_id`,`term`,`inv_year`,`fees_invoice`.`amount`   FROM `fees_invoice`
        JOIN `fees_voteheads` ON `fees_invoice`.`votehead_id` = `fees_voteheads`.`votehead_id` WHERE student_id = $student_id 
        and term = '$term' and inv_year = '$year'" ) );

        $term = 0;
        $year = 0;
        $termyear = '';
        foreach ( $payments  as $pd ) {
            $term = $pd -> term;
            $year = $pd -> inv_year;

        }
        $termyear = $term.'  '.$year;
        $voteheads  = FeeVotehead::all();

        return view( 'fee.invoicestatement', compact( 'voteheads', 'payments', 'studentname', 'termyear' ) );
    }

    public function savenewfee( Request $request, $student_id, $year, $term ) {
        $inputs = $request->all();

        $inputs[ 'student_id' ] = $student_id;
        $inputs[ 'term' ] = $term;
        $inputs[ 'course_id' ] = Student::find( $student_id )->course_id;
        $inputs[ 'inv_year' ] = $year;

        $id = FeeInvoice::create( $inputs )->fee_invoice_id;

        return redirect()->action(
            'SchoolFeeController@viewstatement', $student_id
        );
    }

    public function editFeeInvoice( $student_id, $invoice_id ) {
        $PYS =  DB::table( 'students' )
        ->select( DB::RAW( "CONCAT(first_name,' ',middle_name) AS studentname" ) )
        ->where( 'students.student_id', '=', $student_id )
        ->get();

        $pt = null;
        foreach ( $PYS  as $py ) {
            $pt = $py;
        }
        $studentname = $pt->studentname;

        $payments =  DB::select( DB::raw( " SELECT fees_voteheads.votehead_id, `votehead`, fees_invoice.created_at as payment_date ,  `fee_invoice_id`,`term`,`inv_year`,`fees_invoice`.`amount`   FROM `fees_invoice`
        JOIN `fees_voteheads` ON `fees_invoice`.`votehead_id` = `fees_voteheads`.`votehead_id` WHERE fee_invoice_id = $invoice_id " ) );

        $term = 0;
        $year = 0;
        $termyear = '';
        $invoice = null;
        foreach ( $payments  as $pd ) {
            $term = $pd -> term;
            $year = $pd -> inv_year;
            $invoice =  $pd;
        }
        $termyear = $term.'  '.$year;
        $voteheads = FeeVotehead::all();
        return view( 'fee.editinvoice', compact( 'voteheads', 'invoice', 'studentname', 'termyear' ) );
    }

    public function updatefeeinvoice( Request $request, $student_id, $invoice_id ) {
        $inputs = $request->all();
        $fee_invoice_id = $inputs[ 'fee_invoice_id' ];
        $votehead_id = $inputs[ 'votehead_id' ];
        $amount = $inputs[ 'amount' ];
        $invc = FeeInvoice::find( $fee_invoice_id );
        $invc -> amount =  $amount;
        $invc -> votehead_id =  $votehead_id;
        $invc->save();
        return redirect()->action(
            'SchoolFeeController@viewstatement', $student_id
        );

        // return \Redirect::route( 'viewinvoices', array( 'fee_invoice_id'=>$fee_invoice_id, 'year'=>$invc->inv_year, 'term'=>$invc->term ) );

    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        $voteheads = FeeVotehead::all();
        $courses = Course::all();
        return view( 'fee.createinvoice', compact( 'voteheads', 'courses' ) );

    }

    public function payfee( Request $request ) {
        $input = $request->all();
        $input[ 'payment_date' ]  =  date( 'Y-m-d', strtotime( $input[ 'payment_date' ] ) );
        $id = FeePayment::create( $input )->payment_id;
        //alert()->success( 'Success', 'Invoice Created Successfully' );
        return view( 'fee.feereceipt', compact( 'id' ) );
    }

    public function feereceipts() {
        $payments =  DB::table( 'fee_payments' )
        ->join( 'students', 'fee_payments.student_id', '=', 'students.student_id' )
        ->select( DB::raw( 'fee_payments.*,first_name,middle_name,surname' ) )
        ->where( 'fee_payments.deleted_at', '=', NULL )
        ->orderBy( 'payment_date', 'DESC' )
        ->get();
        return view( 'fee.allreceipts', compact( 'payments' ) );
    }

    public function reprintReceipt( $id ) {

        return view( 'fee.reprintreceipt', compact( 'id' ) );

    }

    public function printReceipt( $id ) {

        $transactions =  DB::select( DB::raw( "SELECT fee_payments.*,CONCAT(first_name,\' \',middle_name,\' \",surname) as studentnames,student_no FROM fee_payments
        JOIN students ON fee_payments.student_id = students.student_id WHERE fee_payments.payment_id = $id " ) );

        $transaction = null;
        $student_id = 0;
        foreach ( $transactions as $transactiond ) {
            $transaction = $transactiond;
            $student_id = $transaction -> student_id;
        }

        $bal  = DB::select( DB::raw( "SELECT 
        ((SELECT COALESCE(SUM(fees_invoice.amount),0) FROM `fees_invoice` WHERE fees_invoice.`student_id` = $student_id and fees_invoice.deleted_at is null)
        -
        (SELECT COALESCE(SUM(fee_payments.amount) , 0) FROM `fee_payments` WHERE fee_payments.`student_id` = $student_id and fee_payments.deleted_at is null)) AS balance
        FROM students " ) );
        $balance = 0 ;
        foreach ( $bal as $bal2 ) {
            $balance = $bal2 ->balance;
        }

        $pdf = new PettyCashReceipt();
        $pdf->AddPage();
        $pdf->SetFont( 'Times', '', 12 );
        //Table with 20 rows and 4 columns
        $pdf->SetX( 5 );
        $pdf->SetFillColor( 237, 228, 226 );

        $pdf->Ln();

        $pdf->SetFillColor( 224, 235, 255 );
        $pdf->setXY( 5, 40 );
        $pdf-> Cell( 200, 8, 'SCHOOL FEE RECEIPT   #RC0'.$id, 1, 0, 'C', 1, '' );

        //DRAW AN OUTER BOX
        $pdf->Line( 5, 5, 205, 5 );
        //TOP
        $pdf->Line( 5, 5, 205, 5 );
        //TOP

        $pdf->Line( 5, 5, 5, 125 );
        //SID1
        $pdf->Line( 5, 5, 5, 125 );
        //SIDE1

        $pdf->Line( 205, 5, 205, 125 );
        //SID2
        $pdf->Line( 205, 5, 205, 125 );
        //SIDE2

        $pdf->Line( 5, 125, 205, 125 );
        //bTOP
        $pdf->Line( 5, 125, 205, 125 );
        //bTOP

        //table header
        $pdf->SetFillColor( 157, 245, 183 );
        $pdf->setFont( 'times', '', '11' );
        $pdf->setXY( 10, 51 );
        $pdf->Cell( 170, 7, 'Transaction Details', 1, 0, 'L', 1 );
        $pdf->Ln();
        $pdf->Cell( 40, 7, 'Transaction : ', 1, 0, 'L', 0 );
        $pdf->Cell( 130, 7,  $transaction ->payment_method.' Payment. Ref : '. $transaction ->reference, 1, 0, 'L', 0 );
        $pdf->Ln();
        $pdf->Cell( 40, 7, 'Transaction Date :', 1, 0, 'L', 0 );
        $pdf->Cell( 130, 7, date_format( date_create( $transaction ->payment_date ), 'd-M-Y' ), 1, 0, 'L', 0 );
        $pdf->Ln();
        $pdf->Cell( 40, 7, 'Amount :', 1, 0, 'L', 0 );
        $pdf->Cell( 130, 7, number_format( $transaction->amount, 2 ), 1, 0, 'L', 0 );
        $pdf->Ln();

        $pdf->SetWidths( array( 40, 130 ) );
        $aligns = array( 'L', 'L' );
        $pdf->SetAligns( $aligns );
        $pdf->SetFillColor( 224, 235, 255 );

        $fill = 1 ;

        $fill =  !$fill;
        $pdf->Row( array( 'Narration : ', 'Fee Payment' ),  $fill );

        $pdf->Ln();

        $pdf->Cell( 20, 7, 'For: ', 0, 0, 'L', 0 );
        $pdf->Cell( 90, 7,  $transaction->studentnames.'    Admn. : '.$transaction->student_no, 0, 0, 'L', 0 );
        $pdf->Cell( 20, 7, 'Served By : ', 0, 0, 'L', 0 );
        $pdf->Cell( 30, 7,  Auth::user()->name, 0, 0, 'L', 0 );
        $pdf->Ln();

        $pdf->Cell( 20, 7, 'Balance :', 0, 0, 'L', 0 );
        $pdf->Cell( 90, 7,  ''.number_format( $balance, 2 ), 0, 0, 'L', 0 );
        $pdf->Cell( 20, 7, 'Date: ', 0, 0, 'L', 0 );
        $pdf->Cell( 30, 7,  date( 'd-m-Y H:i:s' ), 0, 0, 'L', 0 );

        $pdf->Line( 5, 125, 205, 125 );
        //bTOP

        $pdf->setXY( 5, 120 );
        $pdf-> Cell( 200, 5, '', 1, 0, 'C', 1, '' );
        $pdf->Output();
        exit;

    }

    public function saveVotehead( Request $request ) {

        $input = $request->all();
        FeeVotehead::create( $input );
        return back()->withSuccessMessage( 'Successfully Added' );
    }

    public function editvotehead( $id ) {
        $votehead = FeeVotehead::find( $id );
        return view( 'fee.editvotehead', compact( 'votehead' ) );

    }

    public function destroyvotehead( $id ) {
        FeeVotehead::where( 'votehead_id', $id )->delete();
        return redirect()->action(
            'SchoolFeeController@index'
        );
    }

    public function savefeeinvoice( Request $request ) {
        $input = $request->all();
        $course_id = $input[ 'course_id' ];
        $students =  DB::table( 'students' )
        ->select( DB::raw( 'students.student_id' ) )
        ->whereNull( 'students.deleted_at' )
        ->where( 'course_id', '=', $course_id )->get();

        $specialArray = [];
        $specialArray[ 'course_id' ] = $input[ 'course_id' ];
        $specialArray[ 'term' ] = $input[ 'term' ];
        $specialArray[ 'inv_year' ] = $input[ 'inv_year' ];

        $voteheads = FeeVotehead::all();

        foreach ( $students as $student ) {
            foreach ( $voteheads as $votehead ) {
                $amount = $input[ $votehead ->votehead_id ];

                if ( $amount > 0 ) {
                    $specialArray[ 'votehead_id' ] = $votehead ->votehead_id;
                    $specialArray[ 'amount' ] = $amount;
                    $specialArray[ 'student_id' ] = $student->student_id;
                    FeeInvoice::create( $specialArray );
                }
            }
        }

        alert()->success( 'Success', 'Invoice Created Successfully' );
        return redirect()->action(
            'SchoolFeeController@index'
        );

    }

    public function updatevotehead( Request $request, $id ) {
        $FeeVotehead = FeeVotehead::find( $id ) ;
        $input = $request->all();
        $FeeVotehead ->votehead = $input[ 'votehead' ];
        $FeeVotehead ->amount = $input[ 'amount' ];
        $FeeVotehead->save();
        return redirect()->action(
            'SchoolFeeController@index'
        );

    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $input = $request->all();
        Course::create( $input );

        return redirect()->action(
            'CourseController@index'
        );
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
        $course =  Course::find( $id ) ;
        return view( 'courses.edit', compact( 'course' ) );
    }

    public function updateReceipt( Request $request, $id ) {
        $input = $request->all();
        $input[ 'payment_date' ]  =  date( 'Y-m-d', strtotime( $input[ 'payment_date' ] ) );
        $FeePayment = FeePayment::find( $id );

        $FeePayment->payment_date = $input[ 'payment_date' ] ;
        $FeePayment->amount = $input[ 'amount' ] ;
        $FeePayment->reference = $input[ 'reference' ] ;
        $FeePayment->payment_method = $input[ 'payment_method' ] ;
        $FeePayment->save();

        return redirect()->action(
            'SchoolFeeController@feereceipts'
        );

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {

        $course = Course::find( $id ) ;
        $input = $request->all();
        $course ->course_name = $input[ 'course_name' ];
        $course->save();
        return redirect()->action(
            'CourseController@index'
        );

    }

    public function deletefee( $id ) {
        FeePayment::where( 'payment_id', $id )->delete();
        return redirect()->action(
            'SchoolFeeController@feereceipts'
        );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        Course::where( 'course_id', $id )->delete();
        return redirect()->action(
            'CourseController@index'
        );

    }

}

