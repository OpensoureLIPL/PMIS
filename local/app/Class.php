
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('class_uuid', 'title', 'is_trash','is_enable');
}
