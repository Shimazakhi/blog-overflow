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

    Route::get('/', 'BlogController@index');
    Route::get('/posts/{post}', 'BlogController@post');


    Auth::routes();

    Route::get('/home', 'HomeController@index');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
        Route::resource('/posts', 'PostController');
        Route::put('/posts/{post}/publish', 'PostController@publish')->middleware('admin');
        Route::resource('/categories', 'CategoryController', ['except' => ['show']]);
        Route::resource('/tags', 'TagController', ['except' => ['show']]);
        Route::resource('/comments', 'CommentController', ['only' => ['index', 'destroy']]);
        Route::resource('/users', 'UserController', ['middleware' => 'admin', 'only' => ['index', 'destroy']]);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::post('/posts/{post}/comment', 'BlogController@comment');
        Route::post('posts/{post}/comments/{comment}/correct/set', 'BlogController@setCorrectAnswer')->name('post.comment.correct.set');
        Route::post('posts/{post}/comments/{comment}/correct/clear', 'BlogController@clearCorrectAnswer')->name('post.comment.correct.clear');
    });
