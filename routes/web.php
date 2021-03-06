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

Route::get('/home', 'HomeController@index');
Route::get('/file/download/{id}', 'FilesController@download');
Route::get('/get_comments', 'FilesController@getComments');
Route::get('/get_comments_ids', 'FilesController@getCommentsIds');

Route::resource('file', 'FilesController');
Route::resource('comment', 'CommentsController');
