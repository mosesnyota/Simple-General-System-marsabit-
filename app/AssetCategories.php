<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AssetCategories extends Model
{
    use SoftDeletes;
    protected $table = 'asset_categories';
    protected $primaryKey = 'category_id';
    protected $guarded = array(); 
}
