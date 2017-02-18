<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
	protected $fillable = ['event_id', 'participant_id', 'status', 'no', 'price', 'receipt_date', 'paid', 'void'];
    //
    public function setPaidAttribute($value)
    {
    	$this->attributes['paid'] = (boolean)($value);
    }
}
