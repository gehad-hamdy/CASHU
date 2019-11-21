<?php

namespace App\Services;


use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class BestHotelsServices
{
	/**
	 * @param $data
	 */
	public function getBestHotel($data){
		$query = Room::query()->select('hotels.name as hotel','hotels.rate as hotelRate', 'ROUND(SUM(rooms.fare),2) as hotelFare')
			                    ->join('hotels','rooms.hotel_id','=','hotels.id');

		$hotels = $this->getHotelsWithRooms($query, $data);

		if ($hotels)
		     return successResponseWithData($hotels);
		else
			return successResponse('Data not found');
	}

   private function getHotelsWithRooms($query, $data){
		return $query>whereHas('reservationRoom', function ($inner)use ($data){
					$inner->whereBetween('reservation_date', [$data['fromDate'], $data['toDate']])
						->where('adults', $data['numberOfAdults']);
			})
			->where('hotels.city', $data['city'])
			->groupBy('hotels.id')
			->orderBy('rate')
			->with('roomAmenities:name')
			->get();
   }
}
