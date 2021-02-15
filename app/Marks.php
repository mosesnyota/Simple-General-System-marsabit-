<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Marks extends Model
{
    use SoftDeletes;
    protected $table = 'marks';
    protected $primaryKey = 'marks_id';
    protected $guarded = array();
}
