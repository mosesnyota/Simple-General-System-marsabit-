<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Invoice extends Model
{
    use SoftDeletes;
    protected $table = 'invoices';
    protected $primaryKey = 'invoice_id';
    protected $guarded = array(); 
}
