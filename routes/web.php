<?php

//login & register routes
Route::get('login','Login@login_page');
Route::post('login','Login@login');
Route::get('register','Login@register_page');
Route::post('register','Login@register');
//end of login & register

Route::group(['middleware'=>'guest'],function(){
	//enter to news page
	Route::get('/','News@index');
	//loggeed user info
	Route::get('loggedUser','userProfile@logged_user');

	//news page : pots section
	Route::get('getnews','News@get_allnews');
	//get news from id to max
	Route::get('getfrom/{id}','News@news_from');

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
	Route::get('user/{id}','userProfile@user_profile');
	Route::get('get_info/{id}','userProfile@user_info');
	Route::get('get_pics/{id}','userProfile@user_pics');
	Route::post('updatePic','userProfile@updatePic');

	//settings url
	Route::get('restapi','settings@restapi');

	//logout route
	Route::any('logout','Login@logout');
	//end of logout route
});
