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

Route::middleware('auth:api')->namespace('Api')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('forum','ForumController');
    Route::resource('comment','CommentController');
});

Route::get('/tags', function (Request $request) {
    return \App\Tag::pluck('name', 'id');
});
