<?php

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

//Route::get('/', function () {
//    return view('index');
//});

use App\ApiData;


Route::get('/movies', 'MoviesController@index')->name('movies.index');


Route::get('/tech-news', function() {

    // Get HN top stories ids from DB
    $hnTopStories = ApiData::where('name', 'hn')
        ->where('sub_category', 'top stories')
        ->orderBy('created_at', 'desc')
        ->first(['data']);

    return view('hn.index', ['hnTopStories' => $hnTopStories]);
});
