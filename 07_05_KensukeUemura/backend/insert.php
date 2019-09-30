<?php
include("../funcs.php");

//1. POSTデータ取得
$user_name   = $_POST["user_name"];
$plan  = $_POST["plan"];
$email  = $_POST["email"];
$password = $_POST["password"];
$password2 = $_POST["password2"];


if($password !== $password2){ //パスワードが違ったらDBを読む前にresister.phpに戻す
  redirect("../register.php?er=pw");
}else{
  $pdo = db_conn();//DB接続します
  $stmt = $pdo->prepare("SELECT user_name FROM user_table WHERE user_name='$user_name'");//すでに存在するユーザー名ではないか確認
  $status = $stmt->execute();
  if($status==false) {
    sql_error();
  }else{
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if($r["user_name"] == $user_name){ 
      redirect("../register.php?er=id");
    }else{
      //３．データ登録SQL作成
      $stmt = $pdo->prepare("INSERT INTO user_table(user_name,plan,email,password,admin_flg,regist_date)VALUES(:name,:plan,:email,:password,0,sysdate())");
      $stmt->bindValue(':name', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':plan', $plan, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $status = $stmt->execute(); //実行

      //４．データ登録処理後
      if($status==false){
        sql_error();
      }else{
        redirect("../index.php");
      }
    }
  }
}
?>
