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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/detail/{id}', 'HomeController@detail')->where('id', '[0-9]+');
Route::get('/detail/delete/{id}', 'HomeController@delete')->where('id', '[0-9]+');

Route::get('/retrieve/{id}', 'RetrievedTaskController@retrieve')->where('id', '[0-9]+');
Route::get('/retrieve', 'RetrievedTaskController@index')->name('retrieve');
Route::get('/retrieveSenderIndex/{id}', 'RetrievedTaskController@retrieveToSenderIndex')->where('id', '[0-9]+');
Route::get('/task_modification/{id}', 'RetrievedTaskController@taskModificationIndex')->where('id', '[0-9]+');
Route::post('/toSender/{id}', 'RetrievedTaskController@retrieveToSender')->where('id', '[0-9]+');
Route::post('/re_submit/{id}', 'RetrievedTaskController@reSubmit')->where('id', '[0-9]+');

Route::get('/pending', 'PendingController@index')->name('pending');
Route::get('/pending/{id}', 'PendingController@approval')->where('id', '[0-9]+');
Route::get('/pending_process', 'PendingController@process')->name('pending_process');

Route::get('/authorized', 'PendingController@authorized')->name('authorized');


Route::post('/upload', 'UploadController@store');

Route::get('/modification_file_del/{id}/{num}','RetrievedTaskController@delete'); 
