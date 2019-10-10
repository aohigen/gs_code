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

//ユーザーの一覧を取得
$sqlReqest = "SELECT * FROM user_table";
//DBからデータを取得（SQLを変数化して代入するのは自己流）
$stmt = $pdo->prepare("$sqlReqest");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $view .= '<table><tr><th></th><th>ユーザー名</th><th>契約プラン</th><th>メールアドレス</th><th>登録日</th><th>ユーザー権限</th><th></th><th></th></tr>';
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<tr height="50"><td width=50>';
    $view .= $r["id"]."</td><td width=250>
    ".$r["user_name"].'</td><td width=250>'.$r["plan"].'</td><td width=300>'.$r["email"].'</td><td width=150>'.$r["regist_date"].'</td><td width=150>'.$r["admin_flg"].'</td><td width="100"><a href="admin_user.php?id='.$r["user_id"].'" class="btn btn-success">編集</a></td><td width="100"><a class="btn btn-danger delete" href="backend/delete.php?id='.$r["user_id"].'">削除</a></td></tr>';
  }
  $view .= '</table>';
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
    <title>JapanAnalytics</title>
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
                    <h4 class="card-title mb-0">ユーザー管理</h4>
                  </div>
                </div>
                <!-- /.row-->
                <div class="chart-wrapper" style="height:auto;margin-top:10px;">
                <div class="card mx-4">
            <div class="card-body p-4">
              <p class="text-muted">以下からユーザーの情報を任意に更新することができます。</p>
              <?=$view?>
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
    
<script>
    
</script>

<!-- ここよりJavaScript領域 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  </body>
</html>
