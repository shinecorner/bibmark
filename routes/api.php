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
Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@create');

Route::middleware('auth:api')->group(function() {
    // category
    Route::post('category', 'CategoryController@createOrUpdate');
    Route::get('categories', 'CategoryController@getAll');

    // size
    Route::get('sizes', 'SizeController@getAll');

    // Get posts from social network by tags
    Route::get('sponsors/{sponsor}/posts/{network}', 'API\SponsorPostController@index');
});

Route::get('random_product', 'ProductController@random');