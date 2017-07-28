<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrisonerAdmissionDetail extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('admission_uuid', 'prisoner_no','prison_id','offence','section_of_law','court_file_no','case_file_no','crb_no','court_id','offence_district','previous_conviction_nos','commital_date','sentence_date','conviction_date','marital_status','years','months','days','no_of_strokes','em_no_of_days','class_id','fine_amount','fine_amount_only_default','reciept_no','is_trash','is_enable');
}
