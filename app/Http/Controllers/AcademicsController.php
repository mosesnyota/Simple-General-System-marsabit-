<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Marks;
use App\Subject;
use App\Course;
use Auth;
use SweetAlert;
class AcademicsController extends Controller
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
        $activestudentsGender =  DB::table('students')
        ->select(DB::raw('gender, count(gender) AS total'))
        ->where('cur_status', '=', 'active')
        ->where('deleted_at', '=', NULL)
        ->groupBy('gender')
        ->get();

        $male = 0 ;
        $female = 0 ;
        $totalStudents = $activestudentsGender->count();
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

        $courses = Course::all();
        $subjects = Subject::all();


        $latestMarks = DB::select("SELECT marks_id, CONCAT(`first_name`,' ',`middle_name`,' ', `surname`) AS studentsname,
          `exam_type`,`term`,
        `marks`,`subject_name`
         FROM `students` JOIN `marks` ON students.`student_id` = marks.`student_id`
         JOIN `subjects` ON marks.`subject_id` = subjects.`subject_id`
         WHERE students.`deleted_at` IS NULL AND marks.`deleted_at` IS NULL
         ORDER BY marks.`created_at` DESC ");
       
       return view('academics.index',compact('courses','subjects','studentDetails','totalStudents','latestMarks'));
    }


   

    public function proceed(Request $request){
        $inputs = $request->all();

        $course = $inputs['course_id'];
        $year = $inputs['examyear'];

       $subject_id = $inputs['subject_id'];
       $course_id = $inputs['course_id'];
       $examyear = $inputs['examyear'];
       $term = $inputs['term'] ;
       $examtype = $inputs['examtype'] ;


       $marks = DB::SELECT("SELECT `student_id`,`marks` FROM `marks` WHERE
       `subject_id` =$subject_id   AND `course_id` =$course_id    AND `term` = '$term'  AND `exam_type` ='$examtype'  AND `examyear` = $examyear ");
       
      


        $previousMarks = [];
        $last = 0;

         if(count($marks) >0)
         {
             foreach( $marks as $mark){
                $previousMarks[$mark->student_id] = $mark->marks;
                $last = $mark->student_id;
             }

            
         }

       
        $students = DB::SELECT("SELECT CONCAT(`first_name`,' ',`middle_name`,' ', `surname`) AS studentsname,
       students.`student_id`,`student_no` FROM `students` JOIN `student_course` ON 
        `students`.`student_id` = `student_course`.`student_id` 
        WHERE `student_course`.`course_id` =  $course  AND `cur_year` = $year
        AND `cur_status` = 'active' AND `students`.`deleted_at` IS NULL order by first_name asc");
       return view('marks.record',compact('inputs','students','previousMarks'));
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
       $inputs = $request->all();
       $subject_id = $inputs['subject_id'];
       $course_id = $inputs['course_id'];
       $examyear = $inputs['examyear'];
       $term = $inputs['term'] ;
       $examtype = $inputs['examtype'] ;

       $students_s = $inputs['subs'] ;
       $marks_s = $inputs['ads'] ;

      

       $student_ids =explode(',',$students_s); 
       $marks_ids =explode(',',$marks_s);


       $marks = DB::SELECT("SELECT `student_id`,`marks` FROM `marks` WHERE
       `subject_id` =$subject_id   AND `course_id` =$course_id    AND `term` = '$term'  AND `exam_type` ='$examtype'  AND `examyear` = $examyear ");
        
        $previousMarks = [];
        $last = 0;

         if(count($marks) >0)
         {
             foreach( $marks as $mark){
                $previousMarks[$mark->student_id] = $mark->marks;
                $last = $mark->student_id;
             }

            
         }

       $newrecord = [];
       for ($i=0;$i<count($student_ids);$i++){
        $newrecord['subject_id'] =  $subject_id;
        $newrecord['student_id'] = $student_ids[$i];
        $newrecord['staff_id'] = Auth::user()->name;
        $newrecord['term'] =  $term;
        $newrecord['exam_type'] = $examtype;
        $newrecord['examyear'] = $examyear;
        $newrecord['marks'] =  $marks_ids[$i];
        $newrecord['course_id'] = $course_id;

        $std_id = $newrecord['student_id'];
        if(count($marks) >0)
        {
            if(array_key_exists($newrecord['student_id'], $previousMarks)){
                $newmarks =  $newrecord['marks'];
                
                $studentmarks = DB::SELECT("SELECT marks_id, `student_id`,`marks` FROM `marks` WHERE
                `subject_id` =$subject_id   AND `course_id` =$course_id    AND `student_id` =  $std_id  
                AND `term` = '$term'  AND `exam_type` ='$examtype'  AND `examyear` = $examyear ");

                  $markID = 0;
                  foreach($studentmarks as $stdmarks){
                    $markID = $stdmarks->marks_id;
                  }

                  $marksToUpdate = Marks::find($markID);
                  $marksToUpdate->marks= $newrecord['marks'];
                  $marksToUpdate->save();
            }else{
                Marks::create($newrecord);
            }
            
        }else{
            Marks::create($newrecord);
        }
        
       }
       alert()->success('Success', 'Marks Successfully Saved');
     
       return redirect()->action(
        'AcademicsController@index'
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
        $marksd = DB::select("SELECT `marks_id`,term, CONCAT(`first_name`,' ',`middle_name`,' ', `surname`)
         AS studentsname,
           CONCAT(`exam_type`,' ',`term`,' ',`examyear`)  AS exam,
        `marks`,marks.subject_id, `subject_name`
         FROM `students` JOIN `marks` ON students.`student_id` = marks.`student_id`
         JOIN `subjects` ON marks.`subject_id` = subjects.`subject_id`
         WHERE students.`deleted_at` IS NULL AND marks.`deleted_at` IS NULL and marks_id = $id");

         
         foreach($marksd as $markd2){
            $marks = $markd2;
         }
        $subjects = Subject::all();
        $courses = Course::all();
        return view('marks.edit',compact('marks','subjects','courses'));
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
        $marks=Marks::find($id);
        $marks->marks =  $input['marks'];
        $marks->subject_id =  $input['subject_id'];
        $marks->save();
        return redirect()->action(
            'AcademicsController@index'
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
        Marks::where('marks_id',$id)->delete();
            return redirect()->action(
                'AcademicsController@index'
            );
    }
}
