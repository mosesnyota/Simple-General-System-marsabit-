<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class StudentNumber extends Model
{
    use SoftDeletes;
    protected $table = 'studentnumber';
    protected $primaryKey = 'std_id';
    protected $guarded = array(); 
}
