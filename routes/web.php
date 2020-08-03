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


use App\Models\Message;

Route::get('/', function () {
    return view('welcome');
});


Route::namespace('admin')->prefix('admin')
    ->middleware(['auth', 'isAdmin'])->group(function () {
//  categories routes
        Route::resource('category', 'categories');
//  users routes
        Route::resource('user', 'users');
        Route::post('setAdmin/{id}', 'users@setAdmin')->name('user.setAdmin');
        Route::post('removeAdmin/{id}', 'users@removeAdmin')->name('user.removeAdmin');
//  city routes
        Route::resource('city', 'cities');
//  messages routes
        Route::resource('message', 'Contact_Us');
//  posts routes
        Route::resource('post', 'posts');
//  advertisements routes
        Route::resource('advertisement', 'advertisements');
// charities routes
        Route::resource('charity', 'charities');

// Contact us routes
        Route::resource('contact-us', 'Contact_Us');
//  home page routes
        Route::get('home', 'home@index')->name('admin.dashboard');
    });

Auth::routes();

Route::group(['before' => 'auth'], function () {

//  front post routes ;
    Route::get('post/{id}/{slug?}', 'homeController@showPost')->name('front.showPost');
    Route::delete('deletePost/{id}', 'Admin\posts@destroy')->name('front.deletePost');


    Route::resource('mypost', 'FrontEnd\postsController');
//    Route::post('mypost','Admin\posts@store')->name('mypost.store');
//    Route::post('mypost','Admin\posts@update')->name('mypost.update');

//  commentsController routes
    Route::resource('comment', 'FrontEnd\commentsController');
//  membersController routes
    Route::resource('member', 'FrontEnd\membersController');
//  edit password from user
    Route::get('changePassword/{id}', 'FrontEnd\membersController@editPassword')->name('member.editPassword');
    Route::put('changePassword/{id}', 'FrontEnd\membersController@updatePassword')->name('member.updatePassword');
//  edit extra information for user
    Route::post('updateExtra/{id}', 'FrontEnd\membersController@updateExtra')->name('member.updateExtra');
// charity routes
    Route::resource('charities', 'Admin\charities');
    Route::get('charities/{id}/{slug?}', 'Admin\charities@show')->name('charities.show');
    Route::get('charities-edit/{id}/{slug?}', 'Admin\charities@editFromUser')->name('editFromUser');
    Route::get('charity/{id}/members','Admin\charities@displayMembers')->name('displayMembers');
    Route::get('charity/{id}/posts','Admin\charities@displayPosts')->name('displayPosts');

    Route::post('addMember', 'Admin\charities@addMember')->name('addMember');
    Route::delete('charities/{charity_id}/{user_id}', 'Admin\charities@removeMember')->name('removeMember');
    Route::post('search', 'Admin\charities@search')->name('search-name');

    // category route
    Route::get('category/{id}/{slug?}', 'HomeController@categories')->name('front.category');

});
// routes for home page
Route::get('/home', 'HomeController@index')->name('home');


// routes for user contact us
Route::get('contact-us', 'Admin\Contact_Us@create')->name('contactUs');
Route::post('contact-us', 'Admin\Contact_Us@store')->name('send-message');


// routes for user messages
Route::resource('messages', 'FrontEnd\Messages');

Route::post('sendMessages','FrontEnd\Messages@store')->name('messages.store');
Route::get('sent-messages','FrontEnd\Messages@outMessages')->name('outMessages');
Route::get('message/{id}', 'FrontEnd\Messages@getMessages')->name('getMessages');
Route::get('d-messages',function (){
   return view('front-end.users.displayMessages');
});


// this page for try functions

//Route::post('search', 'HomeController@search')->name('search-name');
Route::get('empty', function () {
    $messagesSent = Message::where('user_id',auth()->user()->id)->get();
    $messagesReceived = Message::where('user_id2',auth()->user()->id)->get();
    return view('empty',['messagesSent'=>$messagesSent,'messagesReceived'=>$messagesReceived]);
});



