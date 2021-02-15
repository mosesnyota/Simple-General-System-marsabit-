<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Ledger extends Model
{
    use SoftDeletes;
    protected $table = 'ledger';
    protected $primaryKey = 'LedgerID';
    protected $guarded = array(); 
}
