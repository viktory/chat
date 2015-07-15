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

Route::group(['middleware' => 'guest'], function()
{
    Route::get('/', function () {
        return view('index');
    });
});

Route::get('chat',
    ['as' => 'chat', 'uses' => 'ChatsController@index']);
Route::get('admin',
    ['as' => 'admin', 'uses' => 'ChatsController@admin']);
Route::post('registration',
    ['as' => 'registration', 'uses' => 'UsersController@registration']);
Route::post('login',
    ['as' => 'login', 'uses' => 'UsersController@login']);
Route::get('logout',
    ['as' => 'logout', 'uses' => 'UsersController@logout']);
Route::get('load-history/{from}/{to?}',
    ['as' => 'load-history', 'uses' => 'ChatsController@loadHistory'])
    ->where(['from' => '[0-9]+', 'to' => '[0-9]+']);