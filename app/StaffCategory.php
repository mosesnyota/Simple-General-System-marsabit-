<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class StaffCategory extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'staffcategory_id';
}
