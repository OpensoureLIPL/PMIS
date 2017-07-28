<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('gender_uuid','title','is_trash','is_enable');
}
