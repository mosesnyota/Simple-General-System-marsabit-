<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 


class Activities extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'activity_id';
    protected $dates = ['deleted_at'];
    protected $guarded = array();
    protected $attributes = [
        'completion_date' => null,
    ];
}
