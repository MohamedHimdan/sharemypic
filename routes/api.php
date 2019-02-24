<?php

//login & register routes
Route::post('login','API\Login@login');
//end of login & register

Route::group(['middleware'=>'auth:api'],function(){

	//loggeed user info
	Route::get('loggedUser','API\Login@user');

	//news page : pots section
	Route::get('getnews','News@get_allnews');

	//like ,unlike post
	Route::post('like','likeUn@likeUn');

	//add new post
	Route::post('new_post','uploadPic@uploadPost');

	//notifications routes
	Route::get('noti_get','notifications@noti_get');
	Route::get('noti_counter','notifications@noti_counter');
	Route::post('noti_update','notifications@noti_update');
	//end of notifications

	//user profile
	
	Route::get('get_info/{id}','userProfile@user_info');
	Route::get('get_pics/{id}','userProfile@user_pics');

	//logout route
	Route::any('logout','Login@logout');
	//end of logout route
});

	