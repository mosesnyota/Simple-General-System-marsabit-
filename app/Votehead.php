<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Votehead extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'votehead_id';
    protected $guarded = array();
}
