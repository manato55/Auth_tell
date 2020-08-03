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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/detail/{id}', 'HomeController@detail')->where('id', '[0-9]+')->name('detail');
Route::get('/detail/delete/{id}', 'HomeController@delete')->where('id', '[0-9]+')->name('detail_delete');

Route::get('/selfRetrieve/{id}', 'RetrievedTaskController@retrieve')->where('id', '[0-9]+')->name('selfRetrieve');
Route::get('/retrieve', 'RetrievedTaskController@index')->name('retrieve');
Route::get('/retrieveSenderIndex/{id}', 'RetrievedTaskController@retrieveToSenderIndex')->where('id', '[0-9]+')->name('retrieveSenderIndex');
Route::get('/task_modification/{id}', 'RetrievedTaskController@taskModificationIndex')->where('id', '[0-9]+')->name('task_modification');
Route::post('/toSender/{id}', 'RetrievedTaskController@retrieveToSender')->where('id', '[0-9]+')->name('toSender');
Route::post('/re_submit/{id}', 'RetrievedTaskController@reSubmit')->where('id', '[0-9]+')->name('re_submit');
Route::get('/deleteTask/{id}', 'RetrievedTaskController@deleteTask')->where('id', '[0-9]+')->name('deleteTask');

Route::get('/pending', 'PendingController@index')->name('pending');
Route::get('/pending/{id}', 'PendingController@approval')->where('id', '[0-9]+')->name('pendingApproved');
Route::get('/pending_process', 'PendingController@process')->name('pending_process');

Route::get('/authorized', 'PendingController@authorized')->name('authorized');


Route::post('/upload', 'UploadController@store')->name('upload');

Route::get('/modification_file_del/{id}/{num}','RetrievedTaskController@deleteFile')->name('modification_file_del'); 
Route::get('/account','AccountSettingController@index')->name('account'); 
Route::post('/changeAccount','AccountSettingController@changeAccount')->name('changeAccount'); 
