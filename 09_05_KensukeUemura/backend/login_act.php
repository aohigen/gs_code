<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$user_name   = $_POST["user_name"];
$password_raw = $_POST["password"];
$password = password_hash($password_raw,PASSWORD_DEFAULT);

//1.  DB接続します
include("../funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
$sql = "SELECT * FROM user_table WHERE user_name=:user_name AND life_flg=1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $_POST["user_name"], PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error();
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
//* if(password_verify($lpw, $val["lpw"])){
if(password_verify($_POST["password"],$val["password"])){
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["admin_flg"] = $val['admin_flg'];
  $_SESSION["user_name"] = $val['user_name'];
  $_SESSION["user_id"] = $val['user_id'];
  $_SESSION["plan"] = $val['plan'];
  $login_cnt = $val['login_cnt'] + 1;
  //ユーザーDBの累計ログイン数をアップデート
  $stmt = $pdo->prepare("UPDATE user_table SET login_cnt=$login_cnt WHERE user_id=:id");
  $stmt->bindValue(':id', $val['user_id'], PDO::PARAM_STR);
  $status = $stmt->execute();
  redirect("../index.php?st=lg_sc");
}else{
  //Login失敗時(Logout経由)
  redirect("../login.php?st=lg_er");
}




