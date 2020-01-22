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

//allow anonymoues
Route::get('/auth/login','authController@login')->name('login');
Route::post('/auth/login','authController@loginIn')->name('loginIn');

//authorization basic 
Route::group(['middleware'=>['Authorization']],function(){

  //default route
  Route::get('/', 'homeController@index')->name('homeIndex');

  //security
  Route::get('/auth/index','authController@index')->name('userIndex');
  Route::get('/auth/register','authController@register')->name('userRegister');
  Route::post('/auth/store','authController@store')->name('userStore');
  Route::get('/auth/logout','authController@logout')->name('logout');

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
  Route::get('/person/index','personController@index')->name('personIndex')->middleware('Authorization:administrator|');
  Route::get('/person/create','personController@create')->name('personCreate');
  Route::post('/person/store','personController@store')->name('personStore');
  Route::get('/person/edit/{id}','personController@edit')->name('personEdit');
  Route::put('/person/update','personController@update')->name('personUpdate');
  Route::get('/person/delete','personController@destroy')->name('personDelete');

});


