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

//handle error
Route::get('/error/unAuthorize','errorController@unAuthorize')->name('unAuthorize');

//authorization basic 
Route::group(['middleware'=>['Authorization']],function(){

  //default route
  Route::get('/', 'homeController@index')->name('homeIndex');

  //security
  Route::get('/auth/register','authController@register')->name('userRegister')->middleware('Roles:Administrator');
  Route::post('/auth/store','authController@store')->name('userStore')->middleware('Roles:Administrator');
  Route::get('/auth/logout','authController@logout')->name('logout');

  //Product
  Route::get('/product/index','productController@index')->name('productIndex')->middleware('Roles:Managment|Administrator');
  Route::get('/product/create','productController@create')->name('productCreate')->middleware('Roles:Managment|Administrator');
  Route::post('/product/store','productController@store')->name('productStore')->middleware('Roles:Managment|Administrator');
  Route::get('/product/edit/{id}','productController@edit')->name('productEdit')->middleware('Roles:Managment|Administrator');
  Route::put('/product/update','productController@update')->name('productUpdate')->middleware('Roles:Managment|Administrator');
  Route::get('/product/delete','productController@destroy')->name('productDelete')->middleware('Roles:Managment|Administrator');

  //typeProduct
  Route::get('/typeProduct/index','typeProductController@index')->name('typeProductIndex')->middleware('Roles:Managment|Administrator');
  Route::get('/typeProduct/create','typeProductController@create')->name('typeProductCreate')->middleware('Roles:Managment|Administrator');
  Route::post('/typeProduct/store','typeProductController@store')->name('typeProductStore')->middleware('Roles:Managment|Administrator');
  Route::get('/typeProduct/edit/{id}','typeProductController@edit')->name('typeProductEdit')->middleware('Roles:Managment|Administrator');
  Route::put('/typeProduct/update','typeProductController@update')->name('typeProductUpdate')->middleware('Roles:Managment|Administrator');
  Route::get('/typeProduct/delete','typeProductController@destroy')->name('typeProductDelete')->middleware('Roles:Managment|Administrator');

  //person
  Route::get('/person/index','personController@index')->name('personIndex')->middleware('Roles:Managment|Administrator');
  Route::get('/person/create','personController@create')->name('personCreate')->middleware('Roles:Managment|Administrator');
  Route::post('/person/store','personController@store')->name('personStore')->middleware('Roles:Managment|Administrator');
  Route::get('/person/edit/{id}','personController@edit')->name('personEdit')->middleware('Roles:Managment|Administrator');
  Route::put('/person/update','personController@update')->name('personUpdate')->middleware('Roles:Managment|Administrator');
  Route::get('/person/delete','personController@destroy')->name('personDelete')->middleware('Roles:Managment|Administrator');

});


