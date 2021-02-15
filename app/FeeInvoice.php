<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FeeInvoice extends Model
{
    use SoftDeletes;
    protected $table = 'fees_invoice';
    protected $primaryKey = 'fee_invoice_id';
    protected $guarded = array(); 
}
