<?php

// Route::get('test')->name('test')->uses('TestController@test');

Route::prefix('system')
	->middleware('authorizeUser:superadmin')
	->group(function() {

		Route::get('/link-storage')->uses('SystemController@linkStorage');

	});

Route::post('submit-order')->name('submitOrder')->uses('OrderController@submit');
Route::get('novosti/{slug}')->name('newsItem')->uses('NewsController@show');

// Social Feed Routes
Route::get('api/social-feed/facebook')->name('facebookFeed')->uses('SocialFeedController@getFacebookFeed');
Route::get('api/social-feed/linkedin')->name('linkedinFeed')->uses('SocialFeedController@getLinkedInFeed');


PageRoutes::inject();
