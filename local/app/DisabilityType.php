<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisabilityType extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('disability_type_uuid', 'title', 'is_trash','is_enable');
}
