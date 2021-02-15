<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; 


class PettyCash extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'transactionid';
    protected $guarded = array();
}
