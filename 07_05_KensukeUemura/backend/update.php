<?php
include("../funcs.php");

//ユーザー情報を取得
$user_name = "kensuke";

//DB接続関数の実行
$pdo = db_conn();
//ユーザー情報の取得
$sqlReqest = "SELECT * FROM user_table WHERE user_name='$user_name'";
//DBからデータを取得（SQLを変数化して代入するのは自己流）
$stmt = $pdo->prepare("$sqlReqest");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
}

//1. POSTデータ取得
$user_name_new   = $_POST["user_name"];
$plan  = $_POST["plan"];
$email  = $_POST["email"];
$password = $_POST["password"];
$password2 = $_POST["password2"];


if($password !== $password2){ //パスワードが違ったらDBを読む前にresister.phpに戻す
  redirect("../mypage.php?er=pw");
}else{
  $stmt = $pdo->prepare("SELECT user_name FROM user_table WHERE user_name='$user_name_new'");
  $status = $stmt->execute();
  if($status==false) {
    sql_error();
  }else{
      //３．データ登録SQL作成
      $stmt = $pdo->prepare("UPDATE user_table SET user_name=:name,email=:email,plan=:plan,password=:password WHERE user_id=:id");
      $stmt->bindValue(':name', $user_name_new, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':plan', $plan, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':id', $user_info['user_id'], PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
      $status = $stmt->execute(); //実行

      //４．データ登録処理後
      if($status==false){
        sql_error();
      }else{
        redirect("../mypage.php");
      }
    }
  }
?>
