<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class IssueAsset extends Model
{
    use SoftDeletes;
    protected $table = 'issued_assets';
    protected $primaryKey = 'issued_id';
    protected $guarded = array(); 
}
