<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Marks;
use App\Subject;
use App\Course;
use Auth;
use SweetAlert;
use App\PettyCashPDF;

class ReportFormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        return view('reportforms.openreport',compact('inputs'));
    }

    public function marksSheet(Request $request)
    {
        $inputs = $request->all();
        return view('reportforms.openmarksheet',compact('inputs'));
    }
    

    public function reportForms(Request $request){
        $inputs = $request->all();
        $course_id = $inputs['course_id'];
        $examyear = $inputs['examyear'];
        $term = $inputs['term'] ;
        $examtype = $inputs['examtype'] ;

        $markss = DB::select("SELECT DISTINCT  students.`student_id`,course_name, CONCAT(`first_name`,' ',`middle_name`,' ', `surname`) AS studentsname
        FROM `students` JOIN `marks` ON 
         `students`.`student_id` = `marks`.`student_id` 
          JOIN courses ON courses.`course_id` = marks.`course_id` 
         WHERE  `cur_year` = $examyear AND term = '$term' and exam_type = '$examtype'
         and marks.course_id = '$course_id'
         AND `cur_status` = 'active' AND `students`.`deleted_at` IS NULL ORDER BY student_id ASC");


        $subjects = DB::SELECT("SELECT DISTINCT  subject_id
        FROM `students` JOIN `marks` ON 
         `students`.`student_id` = `marks`.`student_id` 
         WHERE  `cur_year` = $examyear AND term = '$term' and exam_type = '$examtype'
         and course_id = '$course_id'
         AND `cur_status` = 'active' AND `students`.`deleted_at` IS NULL ORDER BY subject_id ASC");

        $pdf = new PettyCashPDF();
        //for every student
        foreach( $markss as $marks){
           // echo ReportFormsController::getName($marks)."<br>";


        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        
        $pdf->Ln(7);
        $pdf-> Cell(195, 9, "REPORT FORM",0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf-> Cell(70, 10, "Name : ". $marks->studentsname,1, 0, 'L', 0, '');
        $pdf->Ln();
        $pdf-> Cell(70, 10, "Course : ". $marks->course_name,1, 0, 'L', 0, '');
        $pdf->Ln();
        $pdf-> Cell(70, 10, $examtype." -- ". $term,1, 0, 'L', 0, '');
        $pdf->Ln(15);
        $pdf->SetFont('Times','',10);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(60, 10, "Subject",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Marks",1, 0, 'C', 1, '');
        $pdf-> Cell(35, 10, "Grade",1, 0, 'C', 1, '');
        $pdf-> Cell(60, 10, "Remark",1, 0, 'C', 1, '');
       
        $pdf->Ln();

        //Query Marks for this student only
        $studentmarks = DB::SELECT("SELECT   marks.subject_id,subjects.`subject_name`, marks
        FROM `students` LEFT JOIN `marks` ON 
         `students`.`student_id` = `marks`.`student_id` 
         LEFT JOIN subjects ON subjects.`subject_id` = marks.`subject_id`
         WHERE  `cur_year` = $examyear AND term = '$term' and exam_type = '$examtype'
         and marks.course_id = '$course_id' AND marks.student_id = $marks->student_id
         AND `cur_status` = 'active' AND `students`.`deleted_at` IS NULL ORDER BY marks.subject_id ASC");
        
        $counter = 1;
        foreach($studentmarks as $sdtmarks){
            $pdf-> Cell(10, 10, $counter,1, 0, 'L', 0, '');
            $pdf-> Cell(60, 10, $sdtmarks->subject_name,1, 0, 'L', 0, '');
            $pdf-> Cell(30, 10, $sdtmarks->marks,1, 0, 'R', 0, '');
            $pdf-> Cell(35, 10, ReportFormsController::getGrade($sdtmarks->marks),1, 0, 'C', 0, '');
            $pdf-> Cell(60, 10, "",1, 0, 'L', 0, '');
            $counter += 1;
            $pdf->Ln();
        }
        



        

        }
        //whole PDF here
        $pdf->Output();
        exit;

    }





///{{$inputs['course_id']}}/{{$inputs['examyear']}}/{{$inputs['term']}}/{{$inputs['examtype']}}/print
    public function printSheet($course_id, $examyear,$term,$examtype){
     
        $markss = DB::select("SELECT DISTINCT  students.`student_id`,course_name, CONCAT(`first_name`,' ',`middle_name`,' ', `surname`) AS studentsname
        FROM `students` JOIN `marks` ON 
         `students`.`student_id` = `marks`.`student_id` 
          JOIN courses ON courses.`course_id` = marks.`course_id` 
         WHERE  `cur_year` = $examyear AND term = '$term' and exam_type = '$examtype'
         and marks.course_id = '$course_id'
         AND `cur_status` = 'active' AND `students`.`deleted_at` IS NULL ORDER BY student_id ASC");


        $arranged = DB::SELECT("SELECT DISTINCT  students.`student_id`,CONCAT(`first_name`,' ',`middle_name`,' ', `surname`) AS studentsname
         ,SUM(marks) AS total
        FROM `students` JOIN `marks` ON 
         `students`.`student_id` = `marks`.`student_id` 
         JOIN subjects ON subjects.`subject_id` = marks.`subject_id`
         WHERE  `cur_year` = $examyear AND term = '$term' and exam_type = '$examtype'
         and marks.course_id = '$course_id'
         AND `cur_status` = 'active' AND `students`.`deleted_at` IS NULL 
         GROUP BY student_id ORDER BY total DESC ");
 
      

        $subjects = DB::SELECT("SELECT DISTINCT  marks.subject_id, subject_name
        FROM `students` JOIN `marks` ON 
         `students`.`student_id` = `marks`.`student_id` 
         JOIN subjects ON subjects.`subject_id` = marks.`subject_id`
         WHERE  `cur_year` = $examyear AND term = '$term' and exam_type = '$examtype'
         and course_id = '$course_id'
         AND `cur_status` = 'active' AND `students`.`deleted_at` IS NULL ORDER BY subject_name ASC");


        $marks = $markss[0];
        $pdf = new PettyCashPDF();
        $pdf->AddPage();
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->SetFont('Times','',12);
        $pdf->Ln(5);
        $pdf-> Cell(195, 9, "MARKS SHEET FOR ".strtoupper($marks->course_name." ".$examtype." -- ". $term),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetFont('Times','',10);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(50, 10, "Student",1, 0, 'C', 1, '');

        $totalSubjects = 0;
        $allSubjects = [];
        foreach($subjects as $subject){
            $pdf-> Cell(15, 10, $subject->subject_name,1, 0, 'C', 1, '');
            $totalSubjects +=1;
        }
        
        $pdf-> Cell(20, 10, "Total",1, 0, 'C', 1, '');
        $pdf-> Cell(15, 10, "Mean",1, 0, 'C', 1, '');
        $pdf-> Cell(15, 10, "Grade",1, 0, 'C', 1, '');
        $pdf->Ln();
        //for every student
        $counter = 1;
        foreach( $arranged as $stdnts){
            $pdf-> Cell(10, 7, $counter,1, 0, 'L', 0, '');
            $pdf-> Cell(50, 7, $stdnts->studentsname,1, 0, 'L', 0, '');
            foreach($subjects as $subject){
                $pdf-> Cell(15, 7, ReportFormsController::getMarks($subject->subject_id,
                $stdnts->student_id,$term,$examtype,$course_id),1, 0, 'C', 0, '');
               
            }

            $pdf-> Cell(20,7, $stdnts->total,1, 0, 'C', 0, '');
            $pdf-> Cell(15, 7,number_format($stdnts->total/$totalSubjects,1),1, 0, 'C', 0, '');
            $pdf-> Cell(15, 7, ReportFormsController::getGrade($stdnts->total/$totalSubjects),1, 0, 'C',0, '');
            $pdf->Ln();
            $counter += 1;
        }

       
        $pdf->Output();
        exit;
    }


    public function getMarks($subject_id,$student_id,$term,$examtype,$course_id){
         $marks = DB::SELECT("SELECT marks FROM `marks` 
         WHERE  term =  '$term' AND exam_type = '$examtype'
         AND course_id = '$course_id' AND subject_id = $subject_id AND student_id = $student_id
         AND `deleted_at` IS NULL");

        $mak = 0;
         foreach($marks as $mk){
            $mak = $mk->marks;
         }
         return  $mak ;
    }

    public function getGrade($marks){

        if($marks >= 80){
            return "A";
        }
        else if($marks > 74 && $marks <= 79 ){
            return "A-";
        }else if($marks > 69 && $marks <= 74 ){
            return "B+";
        }else if($marks > 64 && $marks <= 69 ){
            return "B";
        }else if($marks >= 60 && $marks <= 64 ){
            return "B-";
        }else if($marks > 54 && $marks <= 59 ){
            return "C+";
        }else if($marks > 49 && $marks <= 54 ){
            return "C";
        }else if($marks > 44 && $marks <= 49 ){
            return "C-";
        }else if($marks > 39 && $marks <= 44 ){
            return "D+";
        }else if($marks > 34 && $marks <= 39 ){
            return "D";
        }else if($marks > 29 && $marks <= 34 ){
            return "D-";
        }else if($marks <=29 ){
            return "E";
        }
       
       
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
