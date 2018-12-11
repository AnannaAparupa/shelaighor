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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::prefix('v1')->group(function (){
    Route::get('/posts', 'Api\ApiController@posts');
    Route::get('/categories', 'Api\ApiController@categories');
    Route::get('/tags', 'Api\ApiController@tags');
    Route::get('/posts-by-tags/{slug}', 'Api\ApiController@PostsByTag');
    Route::get('/posts-by-category/{slug}', 'Api\ApiController@PostsByCategory');
    Route::get('/blog-by-slug/{slug}', 'Api\ApiController@BlogBySlug');
    Route::get('/user-role', 'Api\ApiController@userRole');
});

