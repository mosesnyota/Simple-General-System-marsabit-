<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reasons extends Model
{
    

    use SoftDeletes;
    protected $table = 'issue_reasons';
    protected $primaryKey = 'reason_id';
    protected $guarded = array(); 
}
