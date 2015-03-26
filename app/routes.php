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

Route::get('/runcurl',function() {

    //$result=file_get_contents("http://www.nowgoal.com/data/bf_vn.js?".time());
// create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "http://www.nowgoal.com/data/bf_vn.js?".time());

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);
});
Route::get('/syncdata',function() {
    return View::make('syncdata');
});

Route::get('/log',function() {
    Log::info("Run Here");
});

Route::post('/matchs','MatchController@postMatchs');

// Background process
Route::get('/background/updateodd','OddController@updateOdd');


// LOGS
Route::post('/deletelogs','LogController@deleteLog');
Route::get('/logs','LogController@getLog');
Route::get('/apidocs','LogController@getApiDocs');
Route::get('/getApiDoc','LogController@getApiDoc');
Route::match(array('GET', 'POST'), '/setApiDoc','LogController@setApiDoc');

Route::get('/cron','BackgroundProcessController@cron');


