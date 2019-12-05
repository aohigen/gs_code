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

class PagingController extends Controller
{
    //ログイン認証
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function index() {
        return view('welcome');
    }

    public function dashboard() {
        return view('dashboard');
    }

    //ユーザー情報系
    public function user(Request $request) {
        $data = User_profile::find($request->uid);
        return view('user',[
            'user'=>$data
        ]);
    }

    public function user_list() {
        $data = User_profile::all();
        return view('user_list',[
            'users'=>$data
        ]);
    }

    //プロジェクト系
    public function timeline() {
        $data = project::all();
        return view('timeline',[
            'projects'=>$data
        ]);
    }


    //データベース登録系ページ
    public function profile_resist() {
        return view('profile_resist');
    }
    public function new_project() {
        return view('new_project');
    }
}
