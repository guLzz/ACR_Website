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

Route::get('/home', 'HomeController@index')->name('home');

//Services Routes
Route::get('/services', 'ServicesController@index')->name('services');
Route::get('/services/{event_type}/', 'ServicesController@showEvents')->name('showEvents');   //mostra eventos do tipo escolhido (lista)
Route::get('/services/{event_type}/{id}', 'ServicesController@infoEvent')->name('infoEvent'); //mostra mais informacoes sobre o evento selecionado
Route::get('/services/{event_type}/{id}/book', 'ServicesController@book')->name('book'); //reserva o evento respetivo


//Services Reviews
Route::get('/reviews', 'ReviewsController@index')->name('reviews');

//Services AboutUs
Route::get('/about-us', 'AboutUsController@index')->name('aboutus');


//Facebook Routes
Route::get('login/facebook', 'SocialAuthFacebookController@redirectToProvider');
Route::get('login/facebook/callback', 'SocialAuthFacebookController@handleProviderCallback');