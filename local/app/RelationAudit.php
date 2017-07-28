<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleationAudit extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('relation_uuid','title', 'is_trash','is_enable');
}
