<?php
session_start();
include("../funcs.php");
login_check();
$_SESSION["quiz_cnt"]++; //１会のクイズの設問数。クイズ終了フラグに使う。

//POSTデータ取得
$q_id   = $_POST["q_id"];
$quiz_select  = $_POST["quiz_select"];

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


//質問の情報をデータベースから取得
$stmt = $pdo->prepare("SELECT * FROM questions_ohori WHERE q_id='$q_id'");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $question = $stmt->fetch(PDO::FETCH_ASSOC);
}
if($quiz_select == $question["crct_answer"]){
  //正解の場合
  $crct_flg = 1;
  $_SESSION["quiz_crct_cnt"]++; //クイズを通した累計正答数
  $user_info['answer_times']++;
  $user_info['crct_times']++;
}else{
  //不正解の場合
  $crct_flg = 0;
  $user_info['answer_times']++;
}


//回答DBに保存
$stmt = $pdo->prepare("INSERT INTO answers(q_id,crct_flg,user_id,crct_amount,answer_amount,answer_time)VALUES(:q_id,:crct_flg,:id,:crct_amt,:answer_amt,sysdate())");
$stmt->bindValue(':q_id', $q_id, PDO::PARAM_INT); 
$stmt->bindValue(':crct_flg', $crct_flg, PDO::PARAM_INT); 
$stmt->bindValue(':id', $user_info['user_id'], PDO::PARAM_INT);
$stmt->bindValue(':crct_amt', $user_info['crct_times'], PDO::PARAM_INT);
$stmt->bindValue(':answer_amt', $user_info['answer_times'], PDO::PARAM_INT);
// EXIT($stmt);
$status = $stmt->execute(); //実行

//ユーザーDBを更新
$stmt = $pdo->prepare("UPDATE user_table SET answer_times=:answer_times,crct_times=:crct_times WHERE user_id=:id");
$stmt->bindValue(':answer_times', $user_info['answer_times'], PDO::PARAM_STR); 
$stmt->bindValue(':crct_times', $user_info['crct_times'], PDO::PARAM_STR); 
$stmt->bindValue(':id', $user_info['user_id'], PDO::PARAM_INT);
$status = $stmt->execute(); //実行

if($_SESSION["quiz_cnt"]<=$_SESSION["quiz_limit"]){
  redirect("../quiz_self.php?cnt=".$_SESSION["quiz_cnt"]);
}else{
  redirect("quiz_finish.php");
}


?>
