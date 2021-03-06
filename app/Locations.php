<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locations extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'store_id';
    protected $guarded = array();
}
