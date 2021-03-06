<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class InvoiceDetails extends Model
{
    use SoftDeletes;
    protected $table = 'invoice_details';
    protected $primaryKey = 'detail_id';
    protected $guarded = array();  
}
