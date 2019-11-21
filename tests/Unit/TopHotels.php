<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopHotels extends TestCase
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

	public function testSuccessTopHotelsTest()
	{
		$response = $this->json('get','/api/hotels/best-hotels', [
			"from"           => "2019-01-01",
			"to"             => "2019-01-30",
			"city"           => "IATA",
			"adultsCount"    => "4"
		]);

		$response->assertStatus(200)->assertJson([
			"hotelName" =>  "Name of the hotel",
			"rate" => "4",
			"price" => "200",
			"discount" => "0",
			"amenities" => [
				[ "name" => "c"],
				[ "name" => "ss"],
				[ "name" => "eff"],
				[ "name" => "gjgj"]
			]
		]);
	}

	public function testSuccessTopHotelsWithoutReturnDataTest()
	{
		$response = $this->json('get','/api/hotels/best-hotels', [
			"from"          => "2018-11-01",
			"to"            => "2018-12-30",
			"city"              => "IATA",
			"adultsCount"       => "4"
		]);

		$response->assertStatus(200)->assertJson([
			'message' => "Data not found"
		]);
	}

	public function testTopHotelsWithValidationErrorTest()
	{
		$response = $this->json('get','/api/hotels/best-hotels', [
			"from"          => "2019-01-01",
			"to"            => "2019-01-30",
			"city"          => "IATA",
			"adultsCount"   => "6"
		]);

		$response->assertStatus(422)->assertJsonMessage([
			'message' => "adultsCount max value 5",
		]);
	}

	public function testTopHotelsWithoutRequiredCityTest()
	{
		$response = $this->json('get','/api/hotels/best-hotels', [
			"from"           => "2019-01-01",
			"to"             => "2019-01-30",
			"city"           => "",
			"adultsCount"    => "5"
		]);

		$response->assertStatus(422)->assertJsonMessage([
			'message' => "city is required",
		]);
	}

}
