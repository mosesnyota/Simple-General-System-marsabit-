<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'expense_id';
    protected $guarded = array();
    protected $dates = ['deleted_at'];

    
}
