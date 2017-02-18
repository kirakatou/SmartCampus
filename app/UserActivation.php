<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivation extends Model
{
	public $timestamps = false;
    protected $fillable = ['user_id', 'token'];
}
