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
Route::get('/services', 'ServicesController@index')->name('services');
/*Route::get('/services/events/{type?}', function($type){   
    return view($type, ["type"=> $type] );
    //return view($type);
});*/

//Route::get('/services/events', 'ServicesController@showEvents');
//Route::get('/services/bundle', 'ServicesController@showBundle')->name('bundle');
//Route::get('/services/{event_type_name}/{id}', 'ServicesController@infoEvent')->name('{{id}}'); //mostra mais informacoes sobre o evento selecionado
//Route::get('/services/{event_type_name}/{id}/book', 'ServicesController@book')->name('book'); //reserva o evento respetivo


//Reviews Routes
Route::get('/reviews', 'ReviewsController@index')->name('reviews');

//AboutUs Routes
Route::get('/aboutus', 'AboutUsController@index')->name('aboutus');

//Gallery Routes
Route::get('/gallery', 'GalleryController@index')->name('gallery');

//Home Routes
Route::get('/home', 'HomeController@index')->name('home');


//Facebook Routes
Route::get('login/facebook', 'SocialAuthFacebookController@redirectToProvider');
Route::get('login/facebook/callback', 'SocialAuthFacebookController@handleProviderCallback');