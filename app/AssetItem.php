<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AssetItem extends Model
{
    use SoftDeletes;
    protected $table = 'asset_item';
    protected $primaryKey = 'asset_item_id';
    protected $guarded = array(); 
}
