<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('name', 'parent_id','is_trash', 'is_enable');
}
