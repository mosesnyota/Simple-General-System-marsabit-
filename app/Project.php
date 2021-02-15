<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Project extends Model
{
    protected $primaryKey = 'project_id';
    use SoftDeletes;
    protected $guarded = array();
    protected $attributes = [
        'cur_status' => 'Active',
        'completed_on'=> null,
     ];
}
