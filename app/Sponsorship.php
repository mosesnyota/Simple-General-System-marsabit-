<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sponsorship extends Model
{
    

    use SoftDeletes;
    protected $table = 'sponsored_students';
    protected $primaryKey = 'sp_id';
    protected $guarded = array(); 
}
