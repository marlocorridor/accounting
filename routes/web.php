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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/try', function () {
    
    $data = [
        'series' => App\Series::first()->toJson(),
        'accounts' => App\Account::all()->toJson(),
        'sites' => App\Site::all()->toJson(),
        'series_show_url' => route('series.show', App\Series::first()->id),
    ];

    return view('series.entries', $data);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->namespace('Admin')->group(function (){
    Route::resource('series', 'SeriesController');
    Route::get('series/{series}/entries', 'SeriesController@create_entries')
        ->name('series.create_entries');
});
