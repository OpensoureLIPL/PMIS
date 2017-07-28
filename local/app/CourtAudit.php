
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourtAudit extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('court_uuid', 'title', 'address','contact','is_trash','is_enable');
}
