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

//root route
Route::get('/', 'GuestController@index');

//user routes
Route::get('home', 'UserController@index');
Route::get('profile','UserController@getProfile');
Route::post('saveprofile','UserController@saveProfile');
Route::post('saveprofilepic','UserController@savePicture');
Route::post('saveaboutme','UserController@saveAboutMe');

//admin routes
Route::get('admin','AdminController@adminPage');
Route::post('admin', 'AdminController@updateRoles');

//music routes
Route::get('tracks', 'MusicController@getTracks');
Route::get('editplaylist/{id}', 'MusicController@editPlaylist');
Route::get('playlists', 'MusicController@getPlaylists');
Route::get('createplaylist', 'MusicController@getCreatePlaylist');
Route::post('savetrack', 'MusicController@saveTrack');
Route::post('deletetrack', 'MusicController@deleteTrack');
Route::post('saveplaylist/{id?}', 'MusicController@savePlaylist');
Route::post('deleteplaylist', 'MusicController@deletePlaylist');
Route::post('editplaylist', 'MusicController@editPlaylist');

//resource routes
Route::get('image','ResourcesController@loadImage');
Route::get('audio/{id}','ResourcesController@loadAudio');

//guest routes
Route::get('username', 'GuestController@getUserName');
Route::post('username', 'GuestController@postUserName');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
