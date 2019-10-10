<?php
//XSS対応（echoする場所で使用！それ以外はNG）
//スクリプトがスクリプトが送信されたとしても無効化するように「&，<，>，”，’」を自動エスケープ処理
function h($v){
    return htmlspecialchars($v,ENT_QUOTES);
}

//汎用的な時間表示の関数
function YmdHis(){
    echo date("Y年m月d日 H:i:s");
}
function Ymd(){
    echo date("Y年m月d日");
}
function His(){
    echo date("H:i:s");
}
//DB接続するための関数（プロジェクトごとに変更の必要あり）
function db_conn(){
    //1.  DB接続します
    try {
      //Password:MAMP='root',XAMPP=''
      return new PDO('mysql:dbname=quiz_app;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage()); //EXIT（プログラムを止める関数）でエラー警告
    }
  }
//SQLエラー警告
function error(){
  $error = $stmt->errorInfo();
  exit("SQLエラーです:".$error[2]);
}
//リダイレクト
function redirect($url){
    header("Location: ".$url);
}

//ユーザー情報を取得
$user_name = $_SESSION["user_name"];

//ログインチェック
function login_check(){
  if(
    !isset($_SESSION["chk_ssid"])||
    $_SESSION["chk_ssid"] != session_id()
  ){
    redirect("login.php?er=ss");
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}




//フィルタの条件を取得
$filterDim = h($_GET["dim"]);
if($_GET["val"]){
  $filterVal = h($_GET["val"]);
}elseif($_GET["val2"]){
  $filterVal = h($_GET["val2"]);
}
$filterMatchType = h($_GET["match"]);
//アドバンスフィルタ用の検索条件の取得
$filterDim2 = h($_GET["dim_1"]);
if($_GET["val_1"]){
  $filterVal2 = h($_GET["val_1"]);
}elseif($_GET["val2_1"]){
  $filterVal2 = h($_GET["val2_1"]);
}
$filterMatchType2 = h($_GET["match_1"]);
//アドバンスフィルタ３つ目の条件
$filterDim3 = h($_GET["dim_2"]);
if($_GET["val_2"]){
  $filterVal3 = h($_GET["val_2"]);
}elseif($_GET["val2_2"]){
  $filterVal3 = h($_GET["val2_2"]);
}
$filterMatchType3 = h($_GET["match_2"]);


?>