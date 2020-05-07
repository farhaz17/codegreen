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
    return view('welcome');
});

Route::post('/register', 'Auth\RegisterController@create');
Route::get('/register', 'Auth\RegisterController@index')->name('register');

Route::post('/login', 'Auth\LoginController@login');
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/logout', 'Auth\LoginController@destroy')->name('logout');

// Route::get('/verify', 'Auth\VerificationController@index')->name('verify');
Route::post('/verify', 'Auth\VerificationController@verify')->name('verify');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/edit', 'HomeController@edit')->name('edit');
Route::post('/update', 'HomeController@update')->name('update');
