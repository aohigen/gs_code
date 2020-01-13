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
//インデックスページ
// Route::get('/', 'PagingController@dashboard');
Route::get('/', 'PagingController@dashboard');
//ユーザー詳細
Route::get('/user', 'PagingController@user');
//ユーザー一覧
Route::get('/user_list', 'PagingController@user_list');
//ユーザー編集
Route::get('/user_edit', 'PagingController@user_edit');
//プロジェクト登録
Route::get('/new_project', 'PagingController@new_project');
//プロジェクト詳細
Route::get('/project_detail', 'PagingController@project_detail');
//プロジェクト一覧
Route::get('/project_list', 'PagingController@project_list');
//タイムライン
Route::get('/timeline', 'PagingController@timeline');
//マーケット一覧
Route::get('/market_list', 'PagingController@market_list');
//マーケット登録
Route::get('/market_resist', 'PagingController@market_resist');
//アイテム詳細
Route::get('/item_detail', 'PagingController@item_detail');
//フォロワー一覧
Route::get('/follower_list', 'PagingController@follower_list');
//ステークホルダー一覧
Route::get('/staker_list', 'PagingController@staker_list');
//アクション（テスト用）
Route::get('/action', 'PagingController@action');



//データベース系
//ユーザーの編集
Route::post('/user_edit', 'DatabaseController@user_edit');
//フォローする
Route::post('/follow', 'DatabaseController@follow');
//フォローを解除
Route::post('/unfollow', 'DatabaseController@unfollow');
//ステークする
Route::post('/stake', 'DatabaseController@stake');
//ステークを解除する
Route::post('/unstake', 'DatabaseController@unstake');
//CheerUp
Route::post('/cheer_up', 'DatabaseController@cheer_up');
//CheerDown
Route::post('/cheer_down', 'DatabaseController@cheer_down');
//マーケットの登録
Route::post('/market_resist', 'DatabaseController@market_resist');


//認証系
Auth::routes();
Route::get('/home', 'PagingController@dashboard');

Route::get('/logout', 'Auth\LoginController@logout');


//ブロックチェーン系
//ブロックチェーンのアドレスを取得
Route::post('/make_account', 'BlockchainController@make_account');
//アカウント一覧を取得
Route::post('/get_accounts', 'BlockchainController@get_accounts');
//トークンを送信
Route::post('/send_token', 'BlockchainController@send_token');
//新規プロジェクトの登録
Route::post('/new_project', 'BlockchainController@new_project');
//コントラクトの成立
Route::post('/market_contract', 'BlockchainController@market_contract');
//プロジェクトの登録
Route::post('/project_resist', 'BlockchainController@career_memory');
//ブロックチェーンに内容証明
Route::post('/confirm_bc', 'BlockchainController@confirm_bc');


//管理者画面系
Route::get('/user_edit_list', 'PagingController@user_edit_list');


//テスト用領域
Route::get('/ajaxtest', 'DatabaseController@test_edit');

Route::get('/public-event', function(){
    broadcast(new \App\Events\PublicEvent);
    return 'public';
});