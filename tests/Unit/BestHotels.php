<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BestHotels extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

	public function testSuccessBestHotelsTest()
	{
		$response = $this->json('get','/api/hotels/best_hotels', [
			"fromDate"          => "2019-01-01",
			"toDate"            => "2019-12-30",
			"city"              => "IATA",
			"numberOfAdults"    => "4"
		]);

		$response->assertStatus(200)->assertJson([
			 "hotel" =>  "Name of the hotel",
			 "hotelRate" => "4",
 	         "hotelFare" => "20000",
		    "roomAmenities" => [
				 [ "name" => "c"],
				 [ "name" => "ss"],
				 [ "name" => "eff"],
				 [ "name" => "gjgj"]
			]
		]);
	}

	public function testSuccessBestHotelsWithoutReturnDataTest()
	{
		$response = $this->json('get','/api/hotels/best_hotels', [
			"fromDate"          => "2018-11-01",
			"toDate"            => "2018-12-30",
			"city"              => "IATA",
			"numberOfAdults"    => "4"
		]);

		$response->assertStatus(200)->assertJson([
			'message' => "Data not found"
		]);
	}

	public function testBestHotelsWithValidationErrorTest()
	{
		$response = $this->json('get','/api/hotels/best_hotels', [
			"fromDate"          => "2019-01-01",
			"toDate"            => "2019-01-30",
			"city"              => "IATA",
			"numberOfAdults"    => "6"
		]);

		$response->assertStatus(422)->assertJsonMessage([
			'message' => "numberOfAdults max value 5",
		]);
	}

	public function testBestHotelsWithoutRequiredCityTest()
	{
		$response = $this->json('get','/api/hotels/best_hotels', [
			"fromDate"          => "2019-01-01",
			"toDate"            => "2019-01-30",
			"city"              => "",
			"numberOfAdults"    => "5"
		]);

		$response->assertStatus(422)->assertJsonMessage([
			'message' => "city is required",
		]);
	}
}
