<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [ 'name', 'nohp', 'email', 'profession' ];
}
