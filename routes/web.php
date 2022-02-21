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
    return view('auth.login');
});
Auth::routes();

//home
Route::get('/home/top_statistics', 'HomeController@topStatistics')->name('home.top_statistics');
Route::get('/home/movies_chart', 'HomeController@moviesChart')->name('home.movies_chart');
Route::get('/home', 'HomeController@index')->name('home');

//genre routes
Route::get('/genres/data', 'GenreController@data')->name('genres.data');
Route::delete('/genres/bulk_delete', 'GenreController@bulkDelete')->name('genres.bulk_delete');
Route::resource('genres', 'GenreController')->only(['index', 'destroy']);


//movie routes
Route::get('/movies/data', 'MovieController@data')->name('movies.data');
Route::delete('/movies/bulk_delete', 'MovieController@bulkDelete')->name('movies.bulk_delete');
Route::resource('movies', 'MovieController')->only(['index', 'show', 'destroy']);

//actor routes
Route::get('/actors/data', 'ActorController@data')->name('actors.data');
Route::delete('/actors/bulk_delete', 'ActorController@bulkDelete')->name('actors.bulk_delete');
Route::resource('actors', 'ActorController')->only(['index', 'destroy']);

Route::get('/{page}', 'AdminController@index');