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

Route::middleware('auth:api')->get('/user',
function (Request $request) {
		return $request->user();
	});

//Save Article
Route::post('/article/create', 'Api\ArticleController@saveArticle');

//Get Article
Route::get('articles', 'Api\ArticleController@getArticle');

//Delete Article
Route::post('/post-delete', 'Api\ArticleController@postDeleteArticle');

//Get Edit Article
Route::get('/edit/{id}/article', 'Api\ArticleController@getEditArticle');

//Update Article
Route::post('/update/{id}/article', 'Api\ArticleController@postEditArticle');
