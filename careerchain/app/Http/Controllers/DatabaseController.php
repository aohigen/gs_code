<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_project;
use App\User_profile;
use App\Project;
use App\Follow;
use Validator;
use Auth;

class DatabaseController extends Controller
{
    //ログイン認証
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function profile_resist(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
        'nick_name' => 'required|min:2|max:255',
        ]);     
        //バリデーション:エラー 
        if ($validator->fails()) {
        return redirect('/?error')
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
        $user_profiles = new User_profile;
        $user_profiles->user_id = $request->user_id;
        $user_profiles->nick_name = $request->nick_name; 
        $user_profiles->first_name = $request->first_name; 
        $user_profiles->last_name = $request->last_name; 
        $user_profiles->catchcopy = $request->catchcopy; 
        $user_profiles->profile_img = $profile_img_filename; 
        $user_profiles->main_img = $main_img_filename; 
        $user_profiles->birthday = $request->birthday; 
        $user_profiles->website = $request->website; 
        $user_profiles->birth_prefecture = $request->birth_prefecture; 
        $user_profiles->nationality = $request->nationality; 
        $user_profiles->work_company = $request->work_company; 
        $user_profiles->work_industry = $request->work_industry; 
        $user_profiles->work_position = $request->work_position; 
        $user_profiles->final_education = $request->final_education; 
        $user_profiles->skill_set = $request->skill_set; 
        $user_profiles->challenge_skill = $request->challenge_skill; 
        $user_profiles->free_comment = $request->free_comment; 
        $user_profiles->save();
        return redirect('/?profile_resist_success');
    }

    public function new_project(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
        'project_name' => 'required|min:5|max:255',
        ]);     
        //バリデーション:エラー 
        if ($validator->fails()) {
        return redirect('/new_project?error')
        ->withInput()
        ->withErrors($validator);
        }
        // プロジェクト情報の登録
        $projects = new Project;
        $projects->created_user_id = $request->created_user_id;
        $projects->project_name = $request->project_name; 
        $projects->project_detail = $request->project_detail; 
        $projects->project_goal = $request->project_goal; 
        $projects->before_comment = $request->before_comment; 
        $projects->limit_date = $request->limit_date; 
        $projects->status = "start"; 
        $projects->save();
        return redirect('/?new_project_success');
    }

}



