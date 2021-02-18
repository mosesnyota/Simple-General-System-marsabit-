<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use DB;
use App\Course;
use App\StudentCourses;
use App\ClassListPDF;
use SweetAlert;

class StudentsController extends Controller
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
        $students  = DB::select( DB::raw("SELECT students.*, course_name FROM students
        LEFT JOIN courses ON students.course_id = courses.course_id
        WHERE students.cur_status = 'active'
        AND students.deleted_at IS NULL") );
        $courses =Course::all();
        return view('school.students',compact('students','courses'));
    }


    public function getclasslists(Request $request){
        $input = $request->all();
        return view('school.printclasslist',compact('input'));
    }

    public function printClassList($course_id,$cur_year ){
        $students =  DB::select("SELECT students.* FROM `students`
        WHERE deleted_at IS NULL AND (cur_status = 'Active' OR cur_status = 'Suspended')
        and course_id = $course_id
        ORDER BY first_name ASC ");


        $course =  Course::find($course_id); 


        $pdf = new ClassListPDF();
        
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $cours = strtoupper($course->course_name);
        $pdf->Ln(7);
        $pdf-> Cell(195, 10, "STUDENTS CLASS LIST FOR $cours Year $cur_year",0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf->Cell(100, 10, "Full Names",1, 0, 'C', 1, '');
        $pdf-> Cell(85, 10, "",1, 0, 'C', 1, '');
       
        $pdf->Ln();

        $counter = 1;
        $pdf->SetWidths(array(10,100,85));
        $aligns = array('L','L','C','L','C','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        
      
        $fill = 1 ;
        foreach($students as $student){
            $fill =  !$fill;
            $pdf->Row(array( $counter,$student->first_name." ".$student->middle_name." ".$student->surname, ""), $fill);
            $counter++;
            
        }
        $counter--;
        $pdf-> Cell(110, 10, "Total Students : ",1, 0, 'C', 1, '');
        $pdf-> Cell(85, 10, $counter,1, 0, 'R', 1, '');
        $pdf->Output("","Class_List_$cours.pdf");
        exit;

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $courses =Course::all();
       return view('school.newstudent',compact('courses'));
    }

    public function remove($id){
        $student = Student::find($id);
        $student -> cur_status = 'Completed';
        $student ->save();
        alert()->success('Success', 'Student Has been marked as Completed/Left');
        return redirect()->action(
            'StudentsController@index'
        );
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
        $course_id = $input['course_id'];
        unset($input["course_id"]);
        $input['dob'] = date('Y-m-d', strtotime($input['dob']));
        $input['date_joined'] = date('Y-m-d', strtotime($input['date_joined']));
      
        $id = Student::create($input)->student_id;

        $studentCourse = [];
        $studentCourse['course_id'] = $course_id;
        $studentCourse['student_id'] =  $id ;

        $StudentCourses = StudentCourses::create($studentCourse);

        return redirect()->action(
            'StudentsController@index'
        );


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $details = [];
        $details['balance'] = 90;
        $details['totalpaid'] = 90;
        
        $courses =  DB::table('student_course')
        ->leftjoin('courses', 'student_course.course_id', '=', 'courses.course_id')
        ->select(DB::raw('student_course.course_id,courses.course_name'))
        ->where('student_course.student_id', '=', $id)
        ->get();

        return view('school.viewstudent',compact('student','courses','details'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $courses =Course::all();
       

        $student =  DB::table('students')
        ->leftjoin('student_course', 'students.student_id', '=', 'student_course.student_id')
        ->select(DB::raw('students.*, course_id'))
        ->where('students.student_id', '=', $id)
        ->get();

        return view('school.editstudent',compact('student','courses'));
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
        $course_id = $input['course_id'];
        unset($input["course_id"]);
        $input['dob'] = date('Y-m-d', strtotime($input['dob']));
        $input['date_joined'] = date('Y-m-d', strtotime($input['date_joined']));
      
        $student = Student::find($id);
        $student->student_no = $input['student_no'];
        $student->idno = $input['idno'];
        $student->first_name = $input['first_name'];
        $student->middle_name = $input['middle_name'];
        $student->surname = $input['surname'];
        $student->dob = $input['dob'];
        $student->date_joined = $input['date_joined'];
        $student->phone = $input['phone'];
        $student->residence = $input['residence'];
        

        $student->gender = $input['gender'];
        $student->parent_names = $input['parent_names'];
        $student->parents_phone = $input['parents_phone'];
        $student->save();
        
        $studentCourse = StudentCourses::where('student_id', '=', $id)
                ->first();

       if($studentCourse){
        StudentCourses::where('student_id',$id)->delete();
        $studentCourse = [];
        $studentCourse['course_id'] = $course_id;
        $studentCourse['student_id'] =  $id ;
        $StudentCourses = StudentCourses::create($studentCourse);
       }else{
        $studentCourse = [];
        $studentCourse['course_id'] = $course_id;
        $studentCourse['student_id'] =  $id ;

        $StudentCourses = StudentCourses::create($studentCourse);

       }
       

       return redirect()->action(
        'StudentsController@index'
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
        Student::where('Student_id',$id)->delete();
        return redirect()->action(
            'StudentsController@index'
        );
    }
}
