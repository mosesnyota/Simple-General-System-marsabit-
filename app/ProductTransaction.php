<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class ProductTransaction extends Model
{
    use SoftDeletes;
    protected $table = 'product_transactions';
    protected $primaryKey = 'transaction_id';
    protected $guarded = array(); 
}
