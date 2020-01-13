<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Config;
use App\Project;
use App\Stake;
use App\User;
use App\Purchase;
use App\Libs\Eth\Ethereum;

class BlockchainController extends Controller
{
    //ログイン認証
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function make_account(Request $request)
    {
        $token_address = shell_exec('node ' . base_path('resources/assets/js/web3/make_account.js'));
        $token_address = str_replace(array("\r", "\n"), '', $token_address);
        $users = User::find($request->user_id);
        $users->token_address = $token_address;
        $users->save();
        return $token_address;
    }

    public function get_accounts()
    {
        $data = shell_exec('node ' . base_path('resources/assets/js/web3/get_accounts.js'));
        return json_encode($data);
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
        //ブロックチェーンに保存
        $blockchain_id = shell_exec('node ' . base_path('resources/assets/js/web3/career_set.js'." ".$request->project_name."_".$request->project_detail));
        //なぜか改行コードが入ってしまうので、以下の記述で削除
        $blockchain_id = str_replace(array("\r", "\n"), '', $blockchain_id);
        // プロジェクト情報の登録
        $projects = new Project;
        $projects->blockchain_id = $blockchain_id;
        $projects->created_user_id = $request->created_user_id;
        $projects->project_name = $request->project_name; 
        $projects->project_detail = $request->project_detail; 
        $projects->project_goal = $request->project_goal; 
        $projects->before_comment = $request->before_comment; 
        $projects->limit_date = $request->limit_date; 
        $projects->tags = $request->tags; 
        $projects->status = 2; 
        $projects->save();
        return redirect('/project_list?new_project_success');
    }

    //ウェブサイトの内容とブロックチェーン上の内容が全く同じかを検証
    public function confirm_bc(Request $request)
    {
        $data = shell_exec('node ' . base_path('resources/assets/js/web3/career_get.js'." ".$request->blockchain_id." ".$request->project_name."_".$request->project_detail));
        return $data;
    }

    //CareerChainの肝となる配分ロジック
    public function market_contract(Request $request)
    {
        //配分の割合を定義（今後ユーザーごとに買えるようにする場合はここで変更）
        $share_rate = 0.2;
        //わかりやすいように最初にパラメータを変数定義
        $user_id = $request->user_id;
        $owner_id = $request->owner_id;
        $item_id = $request->item_id;
        $price = $request->price;
        $seller_address = User::find($owner_id)->token_address;
        $buyer_address = User::find($user_id)->token_address;
        //なぜか改行コードが入ってしまうので、以下の記述で削除
        $seller_address = str_replace(array("\r", "\n"), '', $seller_address);
        $buyer_address = str_replace(array("\r", "\n"), '', $buyer_address);
        //購入処理
        $trans_id = shell_exec('node ' . base_path('resources/assets/js/web3/token_transfer.js'." ".$seller_address." ".$price." ".$buyer_address));
        $trans_log[] = $trans_id;
        //purchasesテーブルに保存
        $trans_id = str_replace(array("\r", "\n"), '', $trans_id);
        $purchases = new Purchase;
        $purchases->user_id = $user_id;
        $purchases->seller_id = $owner_id;
        $purchases->item_id = $item_id; 
        $purchases->purchase_price = $price;
        $purchases->bc_trans_id = $trans_id;
        $purchases->staker_trans = "sell";
        $purchases->save();
        // //ここからステーカーへの配分処理
        $stakers = Stake::select('stakes.user_id','users.token_address')->leftJoin('users', 'stakes.user_id', '=', 'users.id')->where('stakes.staked_user_id',$owner_id)->get();
        $price = ceil($price*$share_rate);//ループ開始前に配分用の金額にする（小数点だとETHでエラーになるので切り上げ）
        foreach($stakers as $staker){
            $staker_address = str_replace(array("\r", "\n"), '', $staker->token_address);
            //シェアレートを２回かけて、だんだんと減衰
            $price = ceil($price*0.5); //Stakerの人数によってだんだんと半減していく
            $trans_id = shell_exec('node ' . base_path('resources/assets/js/web3/token_transfer.js'." ".$staker_address." ".$price." ".$seller_address));
            $trans_log[] = $trans_id;
            //purchasesテーブルに保存
            $trans_id = str_replace(array("\r", "\n"), '', $trans_id);
            $purchases = new Purchase;
            $purchases->user_id = $owner_id;
            $purchases->seller_id = $staker->user_id;
            $purchases->item_id = $item_id; 
            $purchases->purchase_price = $price;
            $purchases->bc_trans_id = $trans_id;
            $purchases->staker_trans = "stake";
            $purchases->save();
        }
        // あまりを一番手に上げることで、一番手メリットを増大
        $staker_address = str_replace(array("\r", "\n"), '', $stakers[0]->token_address);
        $trans_id = shell_exec('node ' . base_path('resources/assets/js/web3/token_transfer.js'." ".$staker_address." ".$price." ".$seller_address));
        $trans_log[] = $trans_id;
        //purchasesテーブルに保存
        $trans_id = str_replace(array("\r", "\n"), '', $trans_id);
        $purchases = new Purchase;
        $purchases->user_id = $owner_id;
        $purchases->seller_id = $stakers[0]->user_id;
        $purchases->item_id = $item_id; 
        $purchases->purchase_price = $price;
        $purchases->bc_trans_id = $trans_id;
        $purchases->staker_trans = "stake";
        $purchases->save();

        return $trans_log;
    }

    //トークン送付用
    public function send_token(Request $request)
    {
        //わかりやすいように最初にパラメータを変数定義
        $sender_id = $request->sender_id;
        $accepter_id = $request->accepter_id;
        $price = $request->price;
        $sender_address = User::find($sender_id)->token_address;
        $accepter_address = User::find($accepter_id)->token_address;
        //なぜか改行コードが入ってしまうので、以下の記述で削除
        $sender_address = str_replace(array("\r", "\n"), '', $sender_address);
        $accepter_address = str_replace(array("\r", "\n"), '', $accepter_address);
        //購入処理
        $trans_id = shell_exec('node ' . base_path('resources/assets/js/web3/token_transfer.js'." ".$accepter_address." ".$price." ".$sender_address));
        //purchasesテーブルに保存
        $trans_id = str_replace(array("\r", "\n"), '', $trans_id);
        $purchases = new Purchase;
        $purchases->user_id = $sender_id;
        $purchases->seller_id = $accepter_id;
        $purchases->item_id = 999999;
        $purchases->purchase_price = $price;
        $purchases->bc_trans_id = $trans_id;
        $purchases->staker_trans = "send";
        $purchases->save();
        return $trans_id;
    }


}

//コマンド一覧メモ
//https://ethereum.gitbooks.io/frontier-guide/content/rpc.html
// eth_accounts()＝アカウント一覧の取得
// eth_coinbase()＝コインベースアドレスの取得
// eth_getBalance
// eth_getCode
// eth_getTransactionCount
// eth_getStorageAt
// eth_call





