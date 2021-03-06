<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Student extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'student_id';
    protected $guarded = array();
}
