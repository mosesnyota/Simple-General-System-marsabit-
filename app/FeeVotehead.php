<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FeeVotehead extends Model
{
    use SoftDeletes;
    protected $table = 'fees_voteheads';
    protected $primaryKey = 'votehead_id';
    protected $guarded = array(); 
}
