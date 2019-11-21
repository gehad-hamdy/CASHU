<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['name', 'rate', 'fare','price', 'city', 'discount_flag', 'discount_amount'];

	public function rooms(){
    	return $this->belongsToMany(Room::class,'rooms');
	}
}
