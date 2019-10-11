<?php
session_start();
include("../funcs.php");

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
$category_id  = intval($_POST["category_id"]);
$question  = $_POST["question"];
$crct_answer  = $_POST["crct_answer"];
$wrong_answer1 = $_POST["wrong_answer1"];
$wrong_answer2 = $_POST["wrong_answer2"];
$wrong_answer3 = $_POST["wrong_answer3"];
$discription = $_POST["discription"];


//回答DBに保存
$stmt = $pdo->prepare("INSERT INTO questions_ohori(category_id,question,crct_answer,wrong_answer1,wrong_answer2,wrong_answer3,discription,q_status)VALUES(:category_id,:question,:crct_answer,:wrong_answer1,:wrong_answer2,:wrong_answer3,:discription,1)");
$stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT); 
$stmt->bindValue(':question', $question, PDO::PARAM_STR); 
$stmt->bindValue(':crct_answer', $crct_answer, PDO::PARAM_STR); 
$stmt->bindValue(':wrong_answer1', $wrong_answer1, PDO::PARAM_STR); 
$stmt->bindValue(':wrong_answer2', $wrong_answer2, PDO::PARAM_STR); 
$stmt->bindValue(':wrong_answer3', $wrong_answer3, PDO::PARAM_STR); 
$stmt->bindValue(':discription', $discription, PDO::PARAM_STR); 
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $user_info['quiz_makes']++;
}


//NEWSに追加
$stmt = $pdo->prepare("INSERT INTO news(date,title,discription)VALUES(sysdate(),:title,:discription)");
$stmt->bindValue(':title', $_POST["question"], PDO::PARAM_STR); 
$stmt->bindValue(':discription', '新しい問題「'.$_POST["question"].'」が追加されました', PDO::PARAM_STR); 
$status = $stmt->execute();



//ユーザーDBを更新
$stmt = $pdo->prepare("UPDATE user_table SET quiz_makes=:quiz_makes WHERE user_id=:id");
$stmt->bindValue(':quiz_makes', $user_info['quiz_makes'], PDO::PARAM_INT); 
$stmt->bindValue(':id', $user_info['user_id'], PDO::PARAM_INT);
$status = $stmt->execute(); //実行
if($status==false) {
  sql_error();
}else{
  $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
  redirect("../quiz_make.php?st=qz_sc");
}

?>
