<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityLevel extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('security_level_uuid','name','is_trash','is_enable');
}
