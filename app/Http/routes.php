<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//logged in user routes
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/api-overview','ApiController@index');

    Route::get('/api-create','ApiController@apiCreateForm');
    Route::get('/api-update','ApiController@apiUpdateForm');
    Route::get('/api-delete/{id}','ApiController@apiDelete');
    
    Route::get('/api-view/{id}','ApiController@apiView'); 
    // Route::get('/api-view','ApiController@apiView');    

    Route::post('/api-create','ApiController@apiCreate');

    Route::get('/api-bin','ApiController@apiBin'); 
});

//api routes
Route::group(['prefix' => 'api/v1','middleware' => 'apiauth'], function () {
    //the api get request
    Route::get('get', 'ReturnApiData@get');

    //for testing the output of the get request
    Route::get('gettest', 'ReturnApiData@gettest');
});
