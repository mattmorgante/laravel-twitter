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

Route::post('/start',  ['as' => 'start-twitter', 'uses' => 'TwitterController@start']);

Route::get('/userTimeline', function()
{
    return Twitter::getUserTimeline(['screen_name' => 'realdonaldtrump', 'count' => 20, 'format' => 'json']);
});

Route::get('/index', 'twitterController@index');

Route::get('/retweeters/{id}', 'twitterController@tweet');

Route::get('/homeTimeline', function()
{
    return Twitter::getHomeTimeline(['count' => 20, 'format' => 'json']);
});
