<?php
include("../funcs.php");
$edit_user_id = $_GET["id"];

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
$edit_user_name   = $_POST["user_name"];
$edit_plan  = $_POST["plan"];
$edit_email  = $_POST["email"];
$edit_password_raw = $_POST["password"];
$edit_password2 = $_POST["password2"];
$edit_admin_flg = $_POST["admin_flg"];
$edit_life_flg = $_POST["life_flg"];
$edit_password = password_hash($edit_password_raw,PASSWORD_DEFAULT);


if($edit_password !== $edit_password2){ //パスワードが違ったらDBを読む前にresister.phpに戻す
  redirect("../admin_user.php?id=".$edit_user_id."&er=pw");
}else{
  $stmt = $pdo->prepare("SELECT user_name FROM user_table WHERE user_name='$edit_user_name'");
  $status = $stmt->execute();
  if($status==false) {
    sql_error();
  }else{
      //３．データ登録SQL作成
      $stmt = $pdo->prepare("UPDATE user_table SET user_name=:name,email=:email,plan=:plan,password=:password,admin_flg=:admin_flg,life_flg=:life_flg WHERE user_id=:id");
      $stmt->bindValue(':name', $edit_user_name, PDO::PARAM_STR); 
      $stmt->bindValue(':plan', $edit_plan, PDO::PARAM_STR); 
      $stmt->bindValue(':email', $edit_email, PDO::PARAM_STR);  
      $stmt->bindValue(':password', $edit_password, PDO::PARAM_STR);  
      $stmt->bindValue(':admin_flg', $edit_admin_flg, PDO::PARAM_INT);
      $stmt->bindValue(':life_flg', $edit_life_flg, PDO::PARAM_STR);
      $stmt->bindValue(':id', $edit_user_id, PDO::PARAM_INT);  
      $status = $stmt->execute(); //実行

      //４．データ登録処理後
      if($status==false){
        sql_error();
      }else{
        redirect("../admin_user.php?id=".$edit_user_id."&st=success");
      }
    }
  }
?>
