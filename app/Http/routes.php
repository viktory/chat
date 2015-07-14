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

Route::get('/', function () {
    return view('index');
});
Route::post('registration',
    ['as' => 'registration', 'uses' => 'UsersController@registration']);
Route::post('login',
    ['as' => 'login', 'uses' => 'UsersController@login']);
Route::get('logout',
    ['as' => 'logout', 'uses' => 'UsersController@logout']);
Route::get('chat',
    ['as' => 'chat', 'uses' => 'ChatsController@index']);
Route::get('load_history/{id}',
    ['as' => 'load_history', 'uses' => 'ChatsController@loadHistory'])
    ->where('id', '[0-9]+');