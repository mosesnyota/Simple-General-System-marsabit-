<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Sponsor extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'sponsor_id';
    protected $guarded = array();
}
