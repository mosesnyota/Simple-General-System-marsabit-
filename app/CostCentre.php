<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class CostCentre extends Model
{
    use SoftDeletes;
    protected $table = 'costcentre';
    protected $primaryKey = 'CostCentreID';
    protected $guarded = array(); 
}
