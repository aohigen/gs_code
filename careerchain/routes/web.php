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

//ページ振り分け

Route::get('/', 'PagingController@dashboard');

Route::get('/user', 'PagingController@user');

Route::get('/profile_resist', 'PagingController@profile_resist');

Route::get('/new_project', 'PagingController@new_project');

Route::get('/user_list', 'PagingController@user_list');

Route::get('/timeline', 'PagingController@timeline');



//データベース系
//ユーザープロフィールの登録
Route::post('/profile_resist', 'DatabaseController@profile_resist');
//新規プロジェクトの登録
Route::post('/new_project', 'DatabaseController@new_project');


//認証系
Auth::routes();
Route::get('/home', 'HomeController@index')->name('dashboard');

Route::get('/logout', 'Auth\LoginController@logout');