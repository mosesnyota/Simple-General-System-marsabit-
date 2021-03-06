<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class ProductionInvoicePayment extends Model
{
    
    use SoftDeletes;
    protected $table = 'invoice_payment';
    protected $primaryKey = 'payment_id';
    protected $guarded = array(); 
}