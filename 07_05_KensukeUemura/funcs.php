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
      return new PDO('mysql:dbname=Gs_db;charset=utf8;host=localhost','root','root');
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





?>