<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrisonTypeAudit extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('name', 'is_trash', 'is_enable');
}
