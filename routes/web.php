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
Route::get('/product/index','productController@index');
Route::get('/product/create','productController@create')->name('productCreate');
Route::post('/product/store','productController@store')->name('productStore');
Route::get('/product/edit','productController@edit');
Route::put('/product/update','productController@update');