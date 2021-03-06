<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Bill extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'bill_id';
    protected $guarded = array();
}
