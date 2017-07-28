<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class babyDetailAudit extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('baby_details_uuid', 'prisoner_no', 'baby_name','dob','gender','father_name','birth_place','medical_condition',	'handover_date','person_receiving','	address_person_receiving','is_trash','is_enable');
}
