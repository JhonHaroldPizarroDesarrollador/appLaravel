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


Route::get('resultados', 'DataScrapingController@index');


Route::get('create', 'DataScrapingController@create');
Route::post('store', 'DataScrapingController@store');


Route::get('create-single', 'DataScrapingController@createSingle');
Route::post('store-single', 'DataScrapingController@store');

Route::get('create-pagination', 'DataScrapingController@createPagination');

Route::get('datascraping/{id}', 'DataScrapingController@show');
Route::post('datascraping/{id}', 'DataScrapingController@storePagination');

Route::post('datascrapingpagination', 'DataScrapingController@storePagination');

Route::get('paginas-guardadas', 'DataScrapingController@index');

Route::post('paginas-guardadas', 'DataScrapingController@store');


//Route::get('/scraping', 'ScrapingController@example');


Route::get('/scraping', 'ScrapingController@scraping');

Route::get('/scraping-single', 'ScrapingController@scrapingSingle');

Route::get('/scraping-ebay', 'ScrapingController@scrapingEbay');

Route::get('/scraping-linio', 'ScrapingController@scrapingLinio');
