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

Route::view('/admin/login' , 'admin.login')->name('login');

Route::get('/admin/logout' , 'LoginController@adminLogout');

Route::post('/admin/login' , 'LoginController@postLogin');

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => '/admin'] , function(){
    	Route::get('/index' , 'AdminController@showIndex');
    	Route::get('/news/categories' , 'NewsController@categories');
    	Route::get('/recipes/categories' , 'recipesController@categories');
    	Route::get('/news/categories/{id}/edit' , 'NewsController@editCategories');
    	Route::get('/recipes/categories/{id}/edit' , 'recipesController@editCategories');
    	Route::get('/news/categories/updateStatus/{id}' , 'NewsController@updateStatusCategories');
    	Route::get('/recipes/categories/updateStatus/{id}' , 'recipesController@updateStatusCategories');
    	Route::get('/news/updateStatus/{id}' , 'NewsController@updateStatus');
    	Route::get('/recipes/delete/{id}' , 'recipesController@destroy');
        Route::get('/test/delete/{id}' , 'TestController@destroy');
        Route::get('/questions/delete/{id}' , 'questionsController@destroy');
        Route::get('/bonus' , 'AdminController@bonus');
        Route::get('/socials/delete/{id}' , 'socialsController@destroy');
        Route::get('/videos-question/delete/{id}' , 'videoQuestionsController@destroy');
        Route::get('/users/updateStatus/{id}' , 'usersController@destroy');
        Route::get('/users/updateStatus/{id}' , 'usersController@destroy');
        Route::get('/bonus/{id}/edit' , 'AdminController@EditBonus');
        Route::get('/bonus/updateStatus/{id}' , 'AdminController@deleteBonus');
        Route::get('/products/updateStatus/{id}' , 'productsController@destroy');
    	
    	Route::post('/news/categories' , 'NewsController@storeCategories');
    	Route::post('/recipes/categories' , 'recipesController@storeCategories');
        Route::post('/bonus' , 'AdminController@storeBonus');

    	Route::put('/news/categories/{id}' , 'NewsController@updateCategories');
    	Route::put('/recipes/categories/{id}' , 'recipesController@updateCategories');
        Route::put('/bonus/{id}' , 'AdminController@updateBonus');

    	Route::resource('/news' , 'NewsController');
    	Route::resource('/events' , 'EventsController');
    	Route::resource('/recipes' , 'recipesController');
    	Route::resource('/test' , 'TestController');
        Route::resource('/questions' , 'questionsController');
        Route::resource('/socials' , 'socialsController');
        Route::resource('/videos-question' , 'videoQuestionsController');
        Route::resource('/users' , 'usersController');
        Route::resource('/products' , 'productsController');
    });
});

Route::get('migrar' , 'AdminController@migrar');