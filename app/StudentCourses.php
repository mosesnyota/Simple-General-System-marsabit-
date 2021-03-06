<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class StudentCourses extends Model
{
    protected $table = 'student_course';
    protected $primaryKey =  ['course_id', 'student_id'];
    public $incrementing = false;
    protected $guarded = array(); 
}
