<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('disabilities_uuid', 'disability_id', 'prisoner_no','prison_id','is_trash','is_enable');
}
