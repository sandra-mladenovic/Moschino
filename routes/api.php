<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/results','SearchController@searchPost');
Route::post("comment","CommentsController@addComment");
Route::get("comments/{id}","CommentsController@getAllComments");
Route::delete('comment/{id}','Admin\CommentsController@delete');
Route::delete('contact/{id}','Admin\ContactController@delete');
Route::get('contact','Admin\ContactController@allMessages');
Route::get('comment','Admin\CommentsController@allComments');
Route::get('admin','Admin\UserController@usersActivitiesFilterd');
