<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class VoucherDetail extends Model
{
    use SoftDeletes;
    protected $table = 'voucherdetail';
    protected $primaryKey = 'VoucherDetailID';
    protected $guarded = array(); 
}
