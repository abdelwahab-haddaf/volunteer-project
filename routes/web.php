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
//  categories routes
    Route::resource('category','categories');
//  users routes
    Route::resource('user','users');
    Route::post('setAdmin/{id}','users@setAdmin')->name('user.setAdmin');
    Route::post('removeAdmin/{id}','users@removeAdmin')->name('user.removeAdmin');
//  city routes
    Route::resource('city','cities');
//  messages routes
    Route::resource('message','messages');
//  posts routes
    Route::resource('post','posts');
//  advertisements routes
    Route::resource('advertisement','advertisements');
// charities routes
        Route::resource('charity','charities');

// contact us routes
        Route::resource('contact-us','Admin\contact');
//  home page routes
    Route::get('home','home@index')->name('admin.dashboard');
    });

Auth::routes();

Route::group(['before' => 'auth'], function () {

//  front post routes ;
    Route::get('post/{id}/{slug?}','homeController@showPost')->name('front.showPost');
    Route::delete('deletePost/{id}','Admin\posts@destroy')->name('front.deletePost');
    Route::resource('mypost','FrontEnd\postsController');
//    Route::post('mypost','Admin\posts@store')->name('mypost.store');
//    Route::post('mypost','Admin\posts@update')->name('mypost.update');

//  commentsController routes
    Route::resource('comment','FrontEnd\commentsController');
//  membersController routes
    Route::resource('member','FrontEnd\membersController');
//  edit password from user
    Route::get('changePassword/{id}','FrontEnd\membersController@editPassword')->name('member.editPassword');
    Route::put('changePassword/{id}','FrontEnd\membersController@updatePassword')->name('member.updatePassword');
//  edit extra information for user
    Route::post('updateExtra/{id}','FrontEnd\membersController@updateExtra')->name('member.updateExtra');
// charity routes
    Route::resource('charities','Admin\charities');


// category route
Route::get('category/{id}/{slug?}', 'HomeController@categories')->name('front.category');

});

Route::get('/home', 'HomeController@index')->name('home');
// routes for user contact us
Route::get('contact-us','Admin\contact@create')->name('contact-us');
Route::post('contact-us','Admin\contact@store')->name('send-message');

// this page for try functions
Route::get('empty',function (){
  return view('empty');
});

