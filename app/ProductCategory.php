<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;
    protected $table = 'product_category';
    protected $primaryKey = 'category_id';
    protected $guarded = array(); 

}
