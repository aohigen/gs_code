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
    <title>OHORI MANIA! -マイページ</title>
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
                    <h4 class="card-title mb-0">マイページ</h4>
                  </div>
                </div>
                <!-- /.row-->
                <div class="chart-wrapper" style="height:auto;margin-top:10px;">
                <div class="card mx-4">
            <div class="card-body p-4" style="width:60%">
              <h1>情報は最新ですか？</h1>
              <p class="text-muted">内容に変更があった場合、以下のフォームから変更することができます。</p>
              <div class="alert"></div>
              <form method="POST" action="backend/update.php">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user">ユーザー名（半角英数字）</i>
                  </span>
                </div>
                <input class="form-control" type="text" value="<?=$user_info["user_name"]?>" name="user_name">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    現在のプラン
                  </span>
                </div>
                <input class="form-control" type="text" value="<?=$user_info["plan"]?>">
                
                <select id="plan" name="plan" class="pullDown">
                  <option value="null">プランを選んでください</option>
                  <option value="free">無料プラン</option>
                  <option value="silver">シルバープラン</option>
                  <option value="gold">ゴールドプラン</option>
              </select>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">メールアドレス</span>
                </div>
                <input class="form-control" type="text" value="<?=$user_info["email"]?>" name="email">
              </div>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    パスワード
                  </span>
                </div>
                <input class="form-control" type="password"  value="<?=$user_info["password"]?>" name="password">
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    パスワード（確認用）
                  </span>
                </div>
                <input class="form-control" type="password" value="<?=$user_info["password"]?>" name="password2">
              </div>
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
    <?php include("parts/footer.php");?>
    <!-- CoreUI and necessary plugins-->


<!-- ここよりJavaScript領域 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/func.js"></script>
<script>
  let er = getParam("er");
      switch (er) {
        case "pw":
          $('.alert').html('<span style="color:red">パスワードが一致しません。</span>');
          break;
        case "id":
          $('.alert').html('<span style="color:red">すでに登録されているユーザー名です。</span>');
          break;
        case "em":
          $('.alert').html('<span style="color:red">すでに登録されているメールアドレスです。</span>');
          break;
        default:
          break;
      }
</script>

  </body>
</html>
