<?php
//1.POSTでParamを取得
$user_id = $_GET["id"];

//2.DB接続など
include("../funcs.php");
$pdo = db_conn();


//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("DELETE FROM user_table WHERE user_id=:user_id");
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

if($status==false){
    sql_error();
  }else{
    redirect("../admin.php?st=success");
  }

?>
