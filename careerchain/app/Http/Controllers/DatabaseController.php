<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Follow;
use App\Stake;
use App\Cheer;
use App\Market;
use Validator;
use Auth;

class DatabaseController extends Controller
{
    //ログイン認証
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function user_edit(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [

        ]);     
        //バリデーション:エラー 
        if ($validator->fails()) {
        return redirect('/user_edit?uid='.$request->id.'$st=val_error')
        ->withInput()
        ->withErrors($validator);
        }
        //プロフィール画像の処理
        $profile_img_file = $request->file('profile_img'); //fileが空かチェック
        if( !empty($profile_img_file) ){
            //ファイル名を取得
            $profile_img_filename = $profile_img_file->getClientOriginalName();
            //ファイルを移動
            $move = $profile_img_file->move('./upload/profile/',$profile_img_filename);
            }else{
                $profile_img_filename = "";
            }
        //背景画像の処理
        $main_img_file = $request->file('main_img'); //fileが空かチェック
        if( !empty($main_img_file) ){
            //ファイル名を取得
            $main_img_filename = $main_img_file->getClientOriginalName();
            //ファイルを移動
            $move = $main_img_file->move('./upload/main/',$main_img_filename);
            }else{
                $main_img_filename = "";
            }
        // ユーザープロフィールを登録
        $users = User::find($request->id);
        $users->first_name = $request->first_name; 
        $users->last_name = $request->last_name; 
        $users->catchcopy = $request->catchcopy; 
        $users->profile_img = $profile_img_filename; 
        $users->main_img = $main_img_filename; 
        $users->birthday = $request->birthday; 
        $users->website = $request->website; 
        $users->birth_prefecture = $request->birth_prefecture; 
        $users->nationality = $request->nationality; 
        $users->work_company = $request->work_company; 
        $users->work_industry = $request->work_industry; 
        $users->work_position = $request->work_position; 
        $users->final_education = $request->final_education; 
        $users->skill_set = $request->skill_set; 
        $users->challenge_skill = $request->challenge_skill; 
        $users->free_comment = $request->free_comment; 
        $users->save();
        return redirect('/user?uid='.$request->id.'&st=edit_success');
    }


    //フォローの登録
    public function follow(Request $request){
        $follows = new Follow;
        $follows->user_id = $request->user_id;
        $follows->followed_user_id = $request->followed_user_id; 
        $follows->unique_check = $request->user_id.'.'.$request->followed_user_id;
        $follows->save();
    }

    //フォロー解除
    public function unfollow(Request $request){
        $unique_check = $request->user_id.'.'.$request->followed_user_id;
        Follow::where('unique_check', $unique_check)->delete();
    }

    //ステークの登録
    public function stake(Request $request){
        $stakes = new Stake;
        $stakes->user_id = $request->user_id;
        $stakes->staked_user_id = $request->staked_user_id; 
        $stakes->unique_check = $request->user_id.'.'.$request->staked_user_id;
        $stakes->save();
    }

    //ステーク解除
    public function unstake(Request $request){
        $unique_check = $request->user_id.'.'.$request->staked_user_id;
        Stake::where('unique_check', $unique_check)->delete();
    }

    //CheerUp
    public function cheer_up(Request $request){
        $stakes = new Cheer;
        $stakes->project_id = $request->project_id;
        $stakes->cheer_user_id = $request->cheer_user_id; 
        $stakes->unique_check = $request->project_id.'.'.$request->cheer_user_id;
        $stakes->save();
    }

    //CheerDown
    public function cheer_down(Request $request){
        $unique_check = $request->project_id.'.'.$request->cheer_user_id;
        Cheer::where('unique_check', $unique_check)->delete();
    }

    public function market_resist(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'item_type' => 'required|min:5|max:255',
            'item_name' => 'required|min:5|max:255',
            'price' => 'required',
            'item_detail' => 'required|min:5|max:255'
            ]);     
            //バリデーション:エラー 
            if ($validator->fails()) {
            return redirect('/new_project?error')
            ->withInput()
            ->withErrors($validator);
            }
        // アイテムの登録
        $markets = new Market;
        $markets->user_id = $request->user_id;
        $markets->item_type = $request->item_type;
        $markets->item_name = $request->item_name; 
        $markets->item_copy = $request->item_copy;
        $markets->price = $request->price;
        $markets->item_detail = $request->item_detail;
        $markets->sell_scope = $request->sell_scope;
        $markets->save();
        return redirect('/?market_resistmf_success');
    }

}





