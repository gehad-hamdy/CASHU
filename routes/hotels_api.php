<?php

	Route::group(['prefix' => 'hotels'], function () {
		Route::get('best_hotels', 'HotelsController@getBestHotels');
		Route::get('top_hotels',  'HotelsController@getTopHotels');
	});
