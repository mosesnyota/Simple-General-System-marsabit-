<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SystemSetting extends Model
{
    use SoftDeletes;
    protected $table = 'system_settings';
    protected $primaryKey = 'setting_id';
    protected $guarded = array(); 
}
