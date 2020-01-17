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
//default route
Route::get('/', 'homeController@index')->name('homeIndex');

//Product
Route::get('/product/index','productController@index')->name('productIndex');
Route::get('/product/create','productController@create')->name('productCreate');
Route::post('/product/store','productController@store')->name('productStore');
Route::get('/product/edit/{id}','productController@edit')->name('productEdit');
Route::put('/product/update','productController@update')->name('productUpdate');
Route::get('/product/delete','productController@destroy')->name('productDelete');

//typeProduct
Route::get('/typeProduct/index','typeProductController@index')->name('typeProductIndex');
Route::get('/typeProduct/create','typeProductController@create')->name('typeProductCreate');
Route::post('/typeProduct/store','typeProductController@store')->name('typeProductStore');
Route::get('/typeProduct/edit/{id}','typeProductController@edit')->name('typeProductEdit');
Route::put('/typeProduct/update','typeProductController@update')->name('typeProductUpdate');
Route::get('/typeProduct/delete','typeProductController@destroy')->name('typeProductDelete');

//person
Route::get('/person/index','personController@index')->name('personIndex');
Route::get('/person/create','personController@create')->name('personCreate');
Route::post('/person/store','personController@store')->name('personStore');
Route::get('/person/edit/{id}','personController@edit')->name('personEdit');
Route::put('/person/update','personController@update')->name('personUpdate');
Route::get('/person/delete','personController@destroy')->name('personDelete');