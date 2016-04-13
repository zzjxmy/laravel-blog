<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::get('site','SiteController@index');
//Route::any('save','SiteController@save')->name('save');
//Route::any('test','SiteController@test');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {
	//Route::resource('/article','ArticleController');
	Route::auth();

	Route::get('/','ArticleController@index')->name('/');
	Route::get('article-save-show','ArticleController@showSave')->name('article-save');
	Route::get('article-list-show','ArticleController@index')->name('article-index');
	Route::post('article-save','ArticleController@save')->name('article-save');
	Route::get('article-update-show/{id}','ArticleController@showUpdate')->name('article-update-show');
	Route::post('article-update/{id}','ArticleController@update')->name('article-update');
	Route::delete('article-delete','ArticleController@delete')->name('article-delete');
	Route::get('article-show/{id}','ArticleController@showArticle')->name('article-show');

	//Route::controllers([
	//	'auth'=>'Auth\AuthController',
	//]);
	//Route::get('/', function () {
	//	return view('public.base');
	//});
	//Route::get('/home', 'HomeController@index');
	//Route::get('post','PostController@index');
	//Route::get('admin-login','Auth\AdminController@login')->name('admin-login');
});

Route::group(['middleware' => ['web','auth']], function () {
	Route::get('post/create','PostController@create');
	Route::post('post/save','PostController@save')->name('post.save');
	Route::post('post/update','PostController@update')->name('post.update');


});