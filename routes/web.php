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



Route::namespace('admin')->prefix('admin')
    ->middleware(['auth','isAdmin'])->group(function (){
    Route::resource('category','categories');
    Route::resource('user','users');
    Route::post('setAdmin/{id}','users@setAdmin')->name('user.setAdmin');
    Route::post('removeAdmin/{id}','users@removeAdmin')->name('user.removeAdmin');
    Route::resource('city','cities');
    Route::resource('message','messages');
    Route::resource('post','posts');
    Route::get('dashboard','home@index')->name('admin.dashboard');
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('empty',function (){
   return view('empty');
});

