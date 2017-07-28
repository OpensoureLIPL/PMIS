<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityLevelAudit extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('security_level_uuid','name','is_trash','is_enable');
}
