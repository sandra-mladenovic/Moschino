<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ContactController;
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

Route::get('/', "PostsController@getAllPostsWithPagination");
Route::get('/{home?}', "PostsController@getAllPostsWithPagination")->where('home', '(home|index|index.php)')->name('home');

Route::get("/posts/{id}","PostsController@getOnePost")->name("posts.show")->where("id","[0-9]+");
Route::get("/posts_category/{id}","PostsController@getAllPostsFromOneCategory")->where(["id"=> "\d+"]);

Route::get("/login","AuthController@login");
Route::post("/login","AuthController@doLogin");
Route::get("/logout","AuthController@logout")->middleware("isLoggedIn");;
Route::get("/register","AuthController@register");
Route::post("/register","AuthController@doRegister");

Route::resource('/user_posts', 'MyPostsController', ['except' => ['show']])->middleware(['isLoggedIn']);
Route::resource('/user_posts', 'MyPostsController', ['only' => ['show']]);

Route::get('/contact',[ContactController::class, 'index']);
Route::post('/contact/send','ContactController@send');


Route::get('/results','SearchController@searchPost');

Route::prefix("/admin")->middleware(["isLoggedIn","admin"])->group(function(){
    Route::get('/',"Admin\UserController@usersActivities");
    Route::resource('/posts','Admin\PostsController');
    Route::resource('/users','Admin\UserController');
    Route::resource('/category','Admin\CategoryController');
    Route::get('/comments','Admin\CommentsController@index');
    Route::get('/messages','Admin\ContactController@index');
    Route::get('/messages/{id}','Admin\ContactController@view')->where(["id"=> "\d+"]);

});

Route::post('like', 'LikesController@like');
Route::delete('like', 'LikesController@dislike');
