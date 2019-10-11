<?php
session_start();
include("../funcs.php");
login_check();


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

$user_info['quiz_times']++;

//ユーザーDBを更新
$stmt = $pdo->prepare("UPDATE user_table SET quiz_times=:quiz_times WHERE user_id=:id");
$stmt->bindValue(':quiz_times', $user_info['quiz_times'], PDO::PARAM_STR); 
$stmt->bindValue(':id', $user_info['user_id'], PDO::PARAM_INT);
$status = $stmt->execute(); //実行

redirect("../quiz_result.php");


?>
