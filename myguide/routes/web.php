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
Route::post('/services/','ServicesController@addType');
Route::post('/services/delete', 'ServicesController@deleteType');
Route::get('/services/{type}', 'ServicesController@showEvents');


//Events Routes
Route::get('/services/{type}/{id}', 'EventsController@index');
Route::post('/services/{type}/{id}/', 'EventsController@bookNow');
Route::post('/services/{type}/', 'EventsController@addEvent');
Route::post('/services/{type}/{id}/delete/', 'EventsController@deleteEvent');


//Bundle Route
Route::get('/bundle', 'BundleController@index')->name('bundle');
Route::post('/bundle/', 'BundleController@newBundle');

//Reviews Routes
Route::get('/reviews', 'ReviewsController@index')->name('reviews');
Route::post('/reviews/','ReviewsController@addReview');

//AboutUs Routes
Route::get('/aboutus', 'AboutUsController@index')->name('aboutus');

//Gallery Routes
Route::get('/gallery', 'GalleryController@index')->name('gallery');
Route::post('/gallery/filter/', 'GalleryController@filterPics');
Route::post('/gallery/','GalleryController@addPic');
Route::post('/gallery/image/delete/','GalleryController@deletePic');

//Home Routes
Route::get('/home', 'HomeController@index')->name('home');


//Facebook Routes
Route::get('login/facebook', 'SocialAuthFacebookController@redirectToProvider');
Route::get('login/facebook/callback', 'SocialAuthFacebookController@handleProviderCallback');