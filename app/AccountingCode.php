<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class AccountingCode extends Model
{
    use SoftDeletes;
    protected $table = 'accountingcode';
    protected $primaryKey = 'CodeID';
    protected $guarded = array(); 
}
