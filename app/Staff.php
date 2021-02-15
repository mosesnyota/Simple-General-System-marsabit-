<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Staff extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'staffid';
    protected $guarded = array();
}
