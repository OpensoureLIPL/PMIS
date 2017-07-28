<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prison extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('prison_uuid', 'prison_name','phone_no','physical_address','prison_type_id','prison_code','capacity','opening_date','security_level_id','postal_address','gps_location','fax_number','email','magisterial_area','is_trash','is_enable');
}
