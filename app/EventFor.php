<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventFor extends Model
{
    protected $fillable = [ 'event_id', 'department_id' ];
}
