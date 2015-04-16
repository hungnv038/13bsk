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
    return View::make("client.login");
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


Route::post('/settings/sound','SettingController@postSoundSetting');
Route::get('/settings','SettingController@getSettingView');
Route::get('/settings/data/{data_type}','SettingController@getSettingRules');
Route::get('/settings/sound','SettingController@getSoundSettingView');

Route::get('/rules/{id}/editview','SettingController@getEditRuleView');
Route::post('/rules/{id}/delete','RuleController@delete');
Route::put('/rules/{id}/edit','RuleController@edit');
Route::post('/rules','RuleController@add');
Route::get('/rules/addView','SettingController@getAddRuleView');

Route::get('/matchs/{match_id}/odds/view','ClientViewController@getMatchOddView');
Route::get('/matchs/{match_id}/odds/data','ClientViewController@getMatchOddData');

//TEST
Route::get('/test',function() {
    return View::make('client.tabsetting');
});





