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

Route::get('/', function () {
    return view('pages/index');
})->name('home');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login','AuthController@loginSubmit');
Route::post('/register','AuthController@registerSubmit');
Route::get('/logout', 'AuthController@logout')->name('logout');