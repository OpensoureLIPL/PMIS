<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrisonerTypeAudit extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('prisoner_type_uuid','prisoner_no', 'name', 'is_trash','is_enable');
}
