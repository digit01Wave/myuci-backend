<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', ['uses'=>'HomeController@getHome', 'as'=>'home']);

//REST SERVICE
Route::group(['prefix'=>'rest'], function(){
    Route::get('/', ['uses'=>'RestController@getRest', 'as' => 'rest']);
    Route::get('/users', ['uses'=>'RestController@getUsersJSON', 'as'=>'rest-users']);
    Route::get('/events', ['uses'=>'RestController@getEventsJSON', 'as'=>'rest-events']);
});

//EVENT VIEWS
Route::group(['prefix'=>'events'], function(){
    Route::get('/', ['uses'=>'EventController@getEvents', 'as' => 'getEvents']);
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::get('api', ['before' => 'oauth', function() {
    // return the protected resource
    //echo “success authentication”;
    $user_id=Authorizer::getResourceOwnerId(); // the token user_id
    $user=\App\User::find($user_id);// get the user data from database

    return Response::json($user);
}]);

//REGISTRATION AND LOGIN
Route::group(array('before' => 'guest'), function(){
    Route::get('/user/create', array('uses'=>'UserController@getCreate', 'as'=>'getCreate'));
    Route::get('/user/login', array('uses'=>'UserController@getLogin', 'as' => 'getLogin'));

    Route::group(array('before'=>'csrf'), function(){
        Route::post('/user/create', array('uses' => 'UserController@postCreate', 'as'=>'postCreate'));
        Route::post('/user/login', array('uses' => 'UserController@postLogin', 'as'=>'postLogin'));
    });
});

//lOGOUT
Route::group(['before'=>'auth'], function(){
    Route::get('/user/logout', ['uses'=>'UserController@getLogout', 'as'=>'getLogout']);
});
