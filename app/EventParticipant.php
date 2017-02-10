<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
	public $timestamps = false;
	
    protected $fillable = [ 'event_id', 'participant_id', 'signin', 'in_time', 'signout', 'out_time', 'barcode' ];

    public function setInTimeAttribute($value)
    {
    	$this->attributes['in_time'] = (boolean)($value);
    }

    public function setOutTimeAttribute($value)
    {
    	$this->attributes['out_time'] = (boolean)($value);
    }
}
