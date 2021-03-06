<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Suppliers extends Model
{
   

    use SoftDeletes;
    protected $primaryKey = 'supplier_id';
    protected $guarded = array();
}