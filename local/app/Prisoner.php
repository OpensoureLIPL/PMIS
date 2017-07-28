<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prisoner extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('prisoner_uuid', 'prisoner_no','prisoner_type_id','personal_no','	first_name','sur_name','photo','gender_id','dob','place_of_birth','tribe','nationality','finger_print','father_name','mother_name','national_id_no','voters_id_no','permanent_address','district_of_origin','country_of_origin','apparent_religion','height','build','face','eyes','mouth','speech','teeth','lips','ears','hair','marks','deformities','habits','is_trash','is_enable');
}
