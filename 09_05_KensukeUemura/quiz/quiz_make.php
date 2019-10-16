<?php
session_start();
include("funcs.php");
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
?>

<!DOCTYPE html>

<!-- ここからhtml領域 -->
<html lang="ja">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>OHORI MANIA! -クイズ作成</title>
    <!-- Icons-->
    <link href="css/style.css" rel="stylesheet">
    <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
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
                    <h4 class="card-title mb-0">クイズ作成</h4>
                  </div>
                </div>
                <!-- /.row-->
                <div class="chart-wrapper" style="height:auto;margin-top:10px;">
                <div class="card mx-4">
            <div class="card-body p-4" style="width:60%">
              <h1>あなただけの <span style="color:#20a8d8">OHORI</span> を追加しよう！</h1>
              <br>
              <p class="text-muted">みんなの協力で、OHORI MANIA!はもっと魅力的に成長していきます。</p>
              <p class="text-muted">とっておきのOHORIを追加しよう！</p>
              <div class="alert"></div>
              <form method="POST" action="backend/quiz_insert.php">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    クイズのカテゴリ
                  </span>
                </div>
                <select id="filterDimension" name="category_id" class="pullDown">
                  <option>カテゴリを選んでください</option>
                  <option value="1">知ってて当たり前の大堀</option>
                  <option value="2">大堀の歴史</option>
                  <option value="3">知られざる大堀</option>
                  <option value="4">G'sでの大堀</option>
              </select>
              </div>
              <br>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user">問題文</i>
                  </span>
                </div>
                <input class="form-control" type="text" placeholder="簡潔に入力してください" name="question">
              </div>
              <br>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user">正解の回答</i>
                  </span>
                </div>
                <input class="form-control" type="text" placeholder="問題文" name="crct_answer">
              </div>
              <br>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user">間違いの回答</i>
                  </span>
                </div>
                <input class="form-control" type="text" placeholder="誤回答１" name="wrong_answer1">
                <input class="form-control" type="text" placeholder="誤回答２" name="wrong_answer2">
                <input class="form-control" type="text" placeholder="誤回答３" name="wrong_answer3">
              </div>
              <br>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user">解説文</i>
                  </span>
                </div>
                <input class="form-control" type="text" placeholder="回答の後に表示される文章です。" name="discription">
              </div>
              <br><br>
              <button type="submit" class="btn btn-block btn-success" type="button">新しい問題として登録</button>
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
    <?php include("parts/footer.php");?>
    <!-- CoreUI and necessary plugins-->


<!-- ここよりJavaScript領域 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/func.js"></script>
<script>
  let st = getParam("st");
      switch (st) {
        case "qz_sc":
          $('.alert').html('<span style="color:green">新しいクイズとして登録されました！</span>');
          break;
        default:
          break;
      }
</script>

  </body>
</html>
