<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Course;
class CourseController extends Controller
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
        $courses =  DB::table('courses')
                ->leftJoin('student_course', 'student_course.course_id', '=', 'courses.course_id')
                ->select(DB::raw(' courses.*, COUNT(student_course.course_id) AS total '))
                ->whereNull('courses.deleted_at')
                ->groupBy('courses.course_id')
                ->orderBy('course_name','DESC')->get();


        return view('courses.index', compact('courses')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        Course::create($input);
      
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
        $course =  Course::find($id) ;
        return view('courses.edit', compact('course'));
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
        $course = Course::find($id) ;
        $input = $request->all();
        $course ->course_name = $input['course_name'];
        $course->save();
        return redirect()->action(
            'CourseController@index'
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
      
        Course::where('course_id',$id)->delete();
        return redirect()->action(
            'CourseController@index'
        );

    }
}
