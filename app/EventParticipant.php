<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
	public $timestamps = false;
	
    protected $fillable = [ 'event_id', 'participant_id', 'signin', 'in_time', 'signout', 'out_time', 'barcode' ];

    public function setSignInAttribute($value)
    {
    	$this->attributes['signin'] = (boolean)($value);
    }

    public function setSignOutAttribute($value)
    {
    	$this->attributes['signout'] = (boolean)($value);
    }
}
