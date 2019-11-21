<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $fillable = ['name', 'rate', 'hotel_id','price'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function reservationRoom(){
    	return $this->hasMany(ReservationRoom::class);
	}
}
