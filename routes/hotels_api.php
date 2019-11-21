<?php

Route::group(['middleware' => ['lang', 'cors']], function () {
	Route::group(['prefix' => 'hotels'], function () {
		Route::get('best_hotels', 'getBestHotels@HotelsController');
		Route::get('top_hotels', 'getTopHotels@HotelsController');
	});
});
