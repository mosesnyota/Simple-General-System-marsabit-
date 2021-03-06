<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class DisbursmentNew extends Model
{
    //disbursment_id
    use SoftDeletes;
    protected $primaryKey = 'disbursment_id';
    protected $guarded = array();
}
