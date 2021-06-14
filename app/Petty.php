<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Petty extends Model
{
    use SoftDeletes;
    protected $table = 'petties';
    protected $primaryKey  ='pettycash_id';
    protected $guarded = array();
}
