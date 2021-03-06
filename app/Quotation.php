<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Quotation extends Model
{
    protected $table = 'quotations';
    protected $primaryKey = 'invoice_id';
    protected $guarded = array(); 
}
