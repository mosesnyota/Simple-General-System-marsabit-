<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationDetails extends Model
{

    protected $table = 'quotation_details';
    protected $primaryKey = 'detail_id';
    protected $guarded = array();  
}
