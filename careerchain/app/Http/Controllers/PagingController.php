<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Follow;
use App\Cheer;
use App\Stake;
use App\Market;
use App\Purchase;
use Validator;
use Auth;

class PagingController extends Controller
{
    //ログイン認証
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function dashboard() {
        $p_data = Project::all();
        $u_data = User::find(Auth::id());
        $staked = Stake::where('staked_user_id', Auth::id())->count();
        $followed = Follow::where('followed_user_id', Auth::id())->count();
        $income = Purchase::where('seller_id', Auth::id())->sum('purchase_price');
        //ブロックチェーンに残高を確認
        $token = shell_exec('node ' . base_path('resources/assets/js/web3/get_balance.js'." ".$u_data->token_address));
        return view('dashboard',[
            'projects'=>$p_data,
            'user'=>$u_data,
            'token'=>$token,
            'staked'=>$staked,
            'followed'=>$followed,
            'income'=>$income
        ]);
    }

    //ユーザー情報系
    public function user(Request $request) {
        $u_data = User::find($request->uid);
        $staked = Stake::where('staked_user_id', $request->uid)->count();
        $stakes = Stake::where('user_id', $request->uid)->count();
        $followed = Follow::where('followed_user_id', $request->uid)->count();
        $follows = Follow::where('user_id', $request->uid)->count();
        //ブロックチェーンに残高を確認
        $token = shell_exec('node ' . base_path('resources/assets/js/web3/get_balance.js'." ".$u_data->token_address));
        return view('user',[
            'user'=>$u_data,
            'token'=>$token,
            'staked'=>$staked,
            'stakes'=>$stakes,
            'followed'=>$followed,
            'follows'=>$follows
        ]);
    }

    public function user_edit(Request $request) {
        $data = User::find($request->uid);
        return view('user_edit',[
            'user'=>$data
        ]);
    }

    public function user_list() {
        $data = User::all();
        return view('user_list',[
            'users'=>$data
        ]);
    }

    //プロジェクト系
    public function timeline() {
        $p_data = Project::latest()->get();
        return view('timeline',[
            'projects'=>$p_data
        ]);
    }

    public function project_detail(Request $request) {
        $p_data = project::find($request->pid);
        $u_data = User::find($p_data->created_user_id);
        $cheer = Cheer::where('project_id', $request->pid)->count();
        $user_id = Auth::user()->id;
        $cheer_check = Cheer::where('cheer_user_id', $user_id)->exists();//すでにCheerしているか確認
        return view('project_detail',[
            'project'=>$p_data,
            'user'=>$u_data,
            'cheer'=>$cheer,
            'cheer_check'=>$cheer_check
        ]);
    }

    public function project_list() {
        $data = project::all();
        return view('project_list',[
            'projects'=>$data
        ]);
    }

    public function market_list() {
        $markets = market::all();
        foreach($markets as $market){
            $market->user_name = User::find($market->user_id)->name;
        }
        return view('market_list',[
            'markets'=>$markets
        ]);
    }

    public function follower_list(Request $request) {
        $data = Follow::select('follows.user_id','users.name','users.first_name','users.last_name','users.profile_img','users.work_company','users.catchcopy')->leftJoin('users', 'follows.user_id', '=', 'users.id')->where('follows.followed_user_id',$request->fid)->get();
        return view('follower_list',[
            'followers'=>$data
        ]);
    }

    public function staker_list(Request $request) {
        $data = Stake::select('stakes.user_id','users.name','users.first_name','users.last_name','users.profile_img','users.work_company','users.catchcopy')->leftJoin('users', 'stakes.user_id', '=', 'users.id')->where('stakes.staked_user_id',$request->sid)->get();
        return view('staker_list',[
            'stakers'=>$data
        ]);
    }

    //アイテム詳細ページ用
    public function item_detail(Request $request) {
        $data = Market::find($request->item_id);
        return view('item_detail',[
            'item'=>$data,
        ]);
    }


    //データベース登録系ページ
    public function new_project() {
        return view('new_project');
    }
    public function market_resist() {
        return view('market_resist');
    }

    //ブロックチェーン系ページ
    public function action() {
        return view('action');
    }

    //管理画面系ページ
    public function user_edit_list() {
        $users = User::all();
        //ユーザーデータベース以外のデータを取得
        foreach($users as $user){
            //トークン残高を取得してuser変数に追加
            $user->token = shell_exec('node ' . base_path('resources/assets/js/web3/get_balance.js'." ".$user->token_address));
            $user->staked =Stake::where('staked_user_id', $user->id)->count();
            $user->stakes =Stake::where('user_id', $user->id)->count();
            $user->followed =Follow::where('followed_user_id', $user->id)->count();
            $user->follows =Follow::where('user_id', $user->id)->count();
        }
        return view('user_edit_list',[
            'users'=>$users
        ]);
    }



    //テストページ
    public function test() {
        return view('test');
    }
    public function ajaxtest() {
        return view('ajaxtest');
    }
}