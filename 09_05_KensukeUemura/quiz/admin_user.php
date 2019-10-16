<?php
session_start();
include("funcs.php");
login_check();

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
//編集するユーザー情報を取得
$sqlReqest = "SELECT * FROM user_table WHERE user_id='$edit_user_id'";
//DBからデータを取得（SQLを変数化して代入するのは自己流）
$stmt = $pdo->prepare("$sqlReqest");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $edit_user_info = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>OHORI MANIA! -管理者ページ（ユーザー編集）</title>
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
                    <h4 class="card-title mb-0">ユーザー情報 編集画面（管理者用）</h4>
                  </div>
                </div>
                <!-- /.row-->
                <div class="chart-wrapper" style="height:auto;margin-top:10px;">
                <div class="card mx-4">
            <div class="card-body p-4" style="width:60%">
              <h1>一度変更すると戻りません</h1>
              <p class="text-muted">以下のフォームからユーザー情報を編集することができます。</p>
              <a href="admin.php">一覧に戻る</a>
              <div class="alert"></div>
              <form method="POST" action="backend/update_admin.php?id=<?=$edit_user_id?>">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user">ユーザー名（半角英数字）</i>
                  </span>
                </div>
                <input class="form-control" type="text" value="<?=$edit_user_info["user_name"]?>" name="user_name">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    現在のプラン
                  </span>
                </div>
                <input class="form-control" type="text" value="<?=$edit_user_info["plan"]?>">
                
                <select id="filterDimension" name="plan" class="pullDown">
                  <option value="<?=$edit_user_info["plan"]?>">プランを変更する</option>
                  <option value="free">トライアル（30日間無料）</option>
                  <option value="entry">エントリー</option>
                  <option value="standard">スタンダード</option>
                  <option value="enterprise">エンタープライズ</option>
              </select>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">メールアドレス</span>
                </div>
                <input class="form-control" type="text" value="<?=$edit_user_info["email"]?>" name="email">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    パスワード
                  </span>
                </div>
                <input class="form-control" type="password"  value="<?=$edit_user_info["password"]?>" name="password">
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    パスワード（確認用）
                  </span>
                </div>
                <input class="form-control" type="password" value="<?=$edit_user_info["password"]?>" name="password2">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">管理者権限</span>
                </div>
                　<input type="radio" name="admin_flg" value="0" checked>　一般ユーザー
                　<input type="radio" name="admin_flg" value="1">　管理者
                　<input type="radio" name="admin_flg" value="2">　マスター管理者
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    ステータス
                  </span>
                </div>
                <input class="form-control" type="text" value="<?=$edit_user_info["life_flg"]?>">
                
                <select id="filterDimension" name="life_flg" class="pullDown">
                  <option value="<?=$edit_user_info["life_flg"]?>">ステータスを変更する</option>
                  <option value="active">サービス提供中</option>
                  <option value="sleep">休眠中</option>
                  <option value="finish">解約</option>
                  <option value="stop">一時停止</option>
              </select>
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
    <footer class="app-footer">
      <div>
        JapanData
        <span>&copy; 2019 JapanAnalytics.</span>
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
