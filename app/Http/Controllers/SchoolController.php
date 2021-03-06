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
        $students = Student::all();
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

        $students_totals = [];
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
