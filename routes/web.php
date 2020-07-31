<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['user']], function () {
    Route::get('/', 'PostController@index')->name('home');
    Route::post('/submit-post', 'PostController@submitPost');
    Route::get('/news-feed', 'PostController@getNewsFeed');
    Route::get('/shared-feed', 'PostController@getSharedFeed');
    Route::get('/user-news-feed', 'PostController@getNewsFeedByUser');
    Route::post('/submit-comment', 'PostController@submitComment');
    Route::post('/like-post', 'PostController@likePost');
    Route::post('/like-shared-post', 'PostController@likeSharedPost');
    Route::post('/share-post', 'PostController@sharePost');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile-information', 'ProfileController@information');
    Route::post('/update-profile', 'ProfileController@updateProfile');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login','AuthController@loginSubmit');
Route::post('/register','AuthController@registerSubmit');
Route::get('/logout', 'AuthController@logout')->name('logout');