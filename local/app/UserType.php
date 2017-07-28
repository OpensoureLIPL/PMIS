<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
	
	Protected $primaryKey = "id";
	protected $fillable = array('name', 'is_trash', 'is_enable');
}
