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
//creo la rauta y accedo a lmeto index del controlador
Route::get('/users', 'UsersController@index');
Route::get('/user/{id}', 'UsersController@getUser');

Route::get('/configuracion-base', 'DataScrapingController@configuracionbase');

Route::post('data-scraping', 'DataScrapingController@getData')->name('test.store');


Route::get('datascraping', 'DataScrapingController@index');
Route::post('datascraping', 'DataScrapingController@store');

Route::get('datascraping/create', 'DataScrapingController@create');
Route::get('datascraping/{id}', 'DataScrapingController@show');


Route::get('paginas-guardadas', 'DataScrapingController@index');
Route::post('paginas-guardadas', 'DataScrapingController@store');


//Route::get('/scraping', 'ScrapingController@example');


Route::get('/scraping', 'ScrapingController@scraping');
