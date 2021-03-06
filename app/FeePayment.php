<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FeePayment extends Model
{
    use SoftDeletes;
    protected $table = 'fee_payments';
    protected $primaryKey = 'payment_id';
    protected $guarded = array(); 
}
