<?php
session_start();
include("funcs.php");
login_check();
$_SESSION["quiz_limit"] = 10; //クイズが終了する設問数

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
//questionDBのレコード数を取得して、それを上限にランダム生成
$stmt = $pdo->prepare("SELECT COUNT(q_id) FROM questions");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $value = $stmt->fetch();
}
$q_num = intval($value[0]);
$q_id = rand(1,$q_num);
//質問の情報をデータベースから取得
$stmt = $pdo->prepare("SELECT * FROM questions WHERE q_id='$q_id'");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $question = $stmt->fetch(PDO::FETCH_ASSOC);
}
$json = json_encode($question);
//回答をランダムに並び替え
$answer_array = array(answer1=>$question["crct_answer"],answer2=>$question["wrong_answer1"],answer3=>$question["wrong_answer2"],answer4=>$question["wrong_answer3"]);
shuffle($answer_array);
$answer_json = json_encode($answer_array);

//クイズの問題の回答数の変数
$quiz_cnt = 0;
?>

<!DOCTYPE html>
<!-- ここからhtml領域 -->
<html lang="ja">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ソムリエ試験対策</title>
    <!-- Icons-->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <!-- ヘッダーを外部ファイル化 -->
  <?php include("parts/header.php");?>

  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <div class="app-body">
      <!-- サイドメニューを外部ファイル化 -->
       <?php include("parts/sidemenu.php");?>

      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
        <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">

            </div>
          </li>
        </ol>
  
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="card">
              <div class="card-body">
                  <div class="col-sm-5">
                    <h4 class="card-title mb-0">クイズ</h4>
                  </div>
                </div>
                <!-- /.row-->
                <div class="chart-wrapper" style="height:auto;margin-top:10px;">
                <div class="card mx-4">
            <div class="card-body p-4" style="width:100%">
              <h1><?=$question["question"]?></h1>
              <div class="alert"></div>
              <form method="POST" action="backend/quiz_act.php">
              <div class="input-group mb-3">
                <div class="input-group-prepend" style="display:block;">
                <input type="checkbox" name="quiz_select" id="select1" value="<?=$answer_array[0]?>"><label for="select1"><?=$answer_array[0]?></label>　
                <input type="checkbox" name="quiz_select" id="select2" value="<?=$answer_array[1]?>"><label for="select2"><?=$answer_array[1]?></label>　
                <input type="checkbox" name="quiz_select" id="select3" value="<?=$answer_array[2]?>"><label for="select3"><?=$answer_array[2]?></label>　
                <input type="checkbox" name="quiz_select" id="select4" value="<?=$answer_array[3]?>"><label for="select4"><?=$answer_array[3]?></label>
                </div>
              </div>
              <input type="hidden" name="q_id" value="<?=$q_id?>">
              <button type="submit" class="btn btn-block btn-success">更新する</button>
              </form>
            </div>
          </div>
                </div>
              </div>
            </div>
                      <!-- /.col-->
                      <div class="col-sm-6">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
          </div>
        </div>
      </main>
    </div>
    <footer class="app-footer">
      <div>
        WineData
        <span>&copy; 2019 クイズアプリ</span>
      </div>
      <div class="ml-auto">
        <span>Powered by</span>
        3rdPartyTrust
      </div>
    </footer>
    <!-- CoreUI and necessary plugins-->


<!-- ここよりJavaScript領域 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/func.js"></script>
<script>
  let questionArray = JSON.parse('<?=$json?>');
  let answerArray = JSON.parse('<?=$answer_json?>');
  
  $('input[name="quiz_select"]').on('click',function(){
    $('input[name="quiz_select"]').prop('checked',false);
    $(this).prop('checked',true);
  });
</script>

  </body>
</html>
