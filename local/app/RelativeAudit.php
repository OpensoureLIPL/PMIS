<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelativeAudit extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('relatives_uuid	','first_name',,'sur_name','gender','contact_no','physical_address','relation_id','is_trash','is_enable');
}
