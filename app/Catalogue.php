<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Catalogue extends Model
{
    use SoftDeletes;
    protected $table = 'catalogue';
    protected $primaryKey = 'asset_id';
    protected $guarded = array(); 
}

