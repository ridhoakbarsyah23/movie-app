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

Route::get('/', 'AuthController@loginForm')->name('login');
Route::post('/login', 'AuthController@login');

Route::group(['middleware' => 'auth.custom'], function () {
    Route::get('/movies', 'MovieController@index')->name('movies');
    Route::get('/movies/{imdbID}', 'MovieController@show')->name('movies.show');

    Route::post('/favorites', 'FavoriteController@store')->name('favorites.store');
    Route::get('/favorites', 'FavoriteController@index')->name('favorites.index');
    Route::delete('/favorites/{id}', 'FavoriteController@destroy')->name('favorites.destroy');

    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::get('/locale/{lang}', 'LanguageController@setLocale')->name('setLocale');