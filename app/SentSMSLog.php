<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class SentSMSLog extends Model
{
   
    protected $table = 'sentsmslogs';
    protected $primaryKey = 'msg_id';
    protected $guarded = array(); 
}
