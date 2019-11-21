<?php

namespace App\Http\Controllers;

use App\Http\Requests\BestHotelsRequest;
use App\Http\Requests\TopHotelsRequest;
use App\Services\BestHotelsServices;
use App\Services\TopHotelsService;

class HotelsController extends Controller
{
	protected $bestHotelsService;
	protected $topHotelsService;

	/**
	 * HotelsController constructor.
	 * @param BestHotelsServices $bestHotelsService
	 * @param TopHotelsService $topHotelsService
	 */
	public function __construct(BestHotelsServices $bestHotelsService, TopHotelsService $topHotelsService)
	{
		$this->bestHotelsService = $bestHotelsService;
		$this->topHotelsService = $topHotelsService;
	}

	/**
	 * @param BestHotelsRequest $request
	 */
	public function getBestHotels(BestHotelsRequest $request){
    	$data = $request->all();

    	return $this->bestHotelsService->getBestHotel($data);
	}

	/**
	 * @param TopHotelsRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getTopHotels(TopHotelsRequest $request){
		$data = $request->all();

		return $this->topHotelsService->getTopHotels($data);
	}
}
