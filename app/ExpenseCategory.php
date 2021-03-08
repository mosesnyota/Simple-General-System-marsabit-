<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use SoftDeletes;
    
    protected $table = 'expense_categories';
    protected $primaryKey = 'category_id';
    protected $guarded = array();
    

}
