<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    	'name', 'datetime', 'location', 'type', 'pay', 'price', 'capacity', 'image',
    	'poster', 'description'
    ];

    protected $dates = ['datetime'];

    public function setPayAttribute($value)
    {
    	$this->attributes['pay'] = (boolean)($value);
    }
}
