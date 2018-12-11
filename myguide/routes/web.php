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

Auth::routes();

//Services Routes
Route::get('/services', 'ServicesController@index');
//Route::post('/services/','ServicesController@addType');
Route::get('/services/{type}', 'ServicesController@showEvents');


//Events Routes
Route::get('/services/{type}/{id}', 'EventsController@index');
//Route::post('/services/events/', 'ServicesController@addEvents');

//Reviews Routes
Route::get('/reviews', 'ReviewsController@index')->name('reviews');
Route::post('/reviews','ReviewsController@addReview');

//AboutUs Routes
Route::get('/aboutus', 'AboutUsController@index')->name('aboutus');
Route::post('/aboutus','AboutUsController@addInfo');

//Gallery Routes
Route::get('/gallery', 'GalleryController@index')->name('gallery');
Route::post('/gallery','GalleryController@addPic');

//Home Routes
Route::get('/home', 'HomeController@index')->name('home');


//Facebook Routes
Route::get('login/facebook', 'SocialAuthFacebookController@redirectToProvider');
Route::get('login/facebook/callback', 'SocialAuthFacebookController@handleProviderCallback');