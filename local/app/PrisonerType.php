<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrisonerType extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('prisoner_type_uuid', 'name', 'is_trash','is_enable');
}
