<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Course extends Model
{
    use SoftDeletes;
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $guarded = array(); 
}
