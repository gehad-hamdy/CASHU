<?php


namespace App\Services;


use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

class TopHotelsService
{
	/**
	 * @param $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getTopHotels($data){
		$query = Hotel::query()->select('name as hotelName','rate', 'price',
			DB::Raw('CASE WHEN discount_flag == 1 THEN discount_amount ELSE 0 END as discount'));
		$hotels = $this->getHotelsWithRooms($query, $data);

		if ($hotels)
			return successResponseWithData($hotels);
		else
			return successResponse('Data not found');
	}

	/**
	 * @param $query
	 * @param $data
	 * @return mixed
	 */
	private function getHotelsWithRooms($query, $data){
		return $query->whereHas('rooms', function ($deep)use ($data){
			$deep->whereHas('reservationRoom', function ($inner)use ($data){
				$inner->whereBetween('reservation_date', [$data['fromDate'], $data['toDate']])
					->where('adults', $data['numberOfAdults']);
			});
		})
			->where('city', $data['city'])
			->orderBy('rate')
			->with('rooms.roomAmenities:name')
			->get();
	}
}
