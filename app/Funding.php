<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Funding extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'funding_id';
    protected $guarded = array();
    
}
