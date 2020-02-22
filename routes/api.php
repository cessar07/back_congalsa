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

Route::post('/uploadFileMedia' , 'NewsController@uploadFileMedia');
Route::post('/login' , 'ApiController@postLogin');
Route::post('/updateUser/{id}' , 'ApiController@updateUser');

//Routes App

Route::get('/get-user/{id}' , 'ApiController@getUSer');
Route::get('/get-news' , 'ApiController@getNews');
Route::get('/get-recipes' , 'ApiController@getRecipes');
Route::get('/get-events' , 'ApiController@getEvents');
Route::get('/get-socials' , 'ApiController@getSocials');
Route::get('/get-socials/more/{skip}' , 'ApiController@getSocialsMore');
Route::get('/get-news/more/{skip}' , 'ApiController@getNewsMore');
Route::get('/get-events/more/{skip}' , 'ApiController@getNewsMore');
Route::get('/get-messages/{id}' , 'ApiController@getMessages');
Route::get('/get-messages-other/{user}/{id}' , 'ApiController@getMessagesother');
Route::get('/get-ranking/{id}' , 'ApiController@getRanking');
Route::get('/updatePoints/{id}/{points}' , 'ApiController@updatePoints');
Route::get('/get-ranking-sem/{id}' , 'ApiController@getRankingSem');
Route::get('/get-ranking-month/{id}' , 'ApiController@getRankingMonth');
Route::get('/exchange/product/{pro}/{user}' , 'ApiController@exchangeProduct');
Route::get('/get-products/{id}' , 'ApiController@getUserProducts');

Route::post('/uploadGallery' , 'videoQuestionsController@uploadGallery');
Route::post('/uploadPhoto/{id}' , 'ApiController@uploadAvatar');
Route::post('/uploadPhoto/recipe/{recipe}/{user}' , 'ApiController@uploadPhotoRecipe');
Route::post('/updateDetailRecipe/{id}' , 'ApiController@updateDetailRecipe');
Route::post('/uploadPhoto/event/{event}/{user}' , 'ApiController@uploadPhotoEvent');
Route::post('/updateDetailEvent/{id}' , 'ApiController@updateDetailEvent');
Route::post('/sendMessage/' , 'ApiController@sendMessage');
