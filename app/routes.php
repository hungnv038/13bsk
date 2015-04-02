<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {
    return View::make("hello");
});
Route::get('/syncdata',function() {
    return View::make('syncdata');
});

//// APIS
Route::post('/matchs','MatchController@postMatchs');
Route::get('/cron','BackgroundProcessController@cron');

// Background process
Route::get('/background/updateodd','OddController@updateOdd');


Route::get('/background/matchs/delete','BackgroundProcessController@deleteMatchs');

Route::get('/background/matchs/status','OddController@updateMatchStatus');



// PAGES

// LOGS
Route::post('/deletelogs','LogController@deleteLog');
Route::get('/logs','LogController@getLog');
Route::get('/apidocs','LogController@getApiDocs');
Route::get('/getApiDoc','LogController@getApiDoc');
Route::match(array('GET', 'POST'), '/setApiDoc','LogController@setApiDoc');

// CLIENTS
Route::get('/matchs/data','ClientViewController@getMatchsData');
Route::get('/matchs','ClientViewController@getMatchsView');

Route::get('/matchs/{match_id}/odds/view','ClientViewController@getMatchOddView');
Route::get('/matchs/{match_id}/odds/data','ClientViewController@getMatchOddData');





