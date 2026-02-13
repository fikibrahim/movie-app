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

// Root URL
Route::get('/', function () {
    if (session()->has('user')) {
        return redirect('/movies');
    }

    return redirect('/login');
});

// Login
Route::get('/login', 'AuthController@showLogin')->name('login');
Route::post('/login', 'AuthController@login');

// Logout
Route::get('/logout', 'AuthController@logout');

// Protected Routes
Route::middleware('auth.custom')->group(function () {
    Route::get('/movies', 'MovieController@index');
    Route::get('/movies/{id}', 'MovieController@detail');
    Route::post('/favorite', 'FavoriteController@store');
    Route::get('/favorites', 'FavoriteController@index');
    Route::delete('/favorite/{id}', 'FavoriteController@destroy');
});
