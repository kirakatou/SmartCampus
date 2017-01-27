<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable = ['nim', 'name', 'gender', 'dob', 'email', 'religion', 'department_id', 'classname', 'image'];

	protected $dates = ['dob'];
    //
}
