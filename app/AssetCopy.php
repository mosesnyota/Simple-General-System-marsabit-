<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AssetCopy extends Model
{
    use SoftDeletes;
    protected $table = 'asset_copy';
    protected $primaryKey = 'asset_copy_id';
    protected $guarded = array(); 
}
