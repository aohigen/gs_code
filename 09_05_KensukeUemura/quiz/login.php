<?php
session_start();
$sid = session_id();
?>

<html lang="ja">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>OHORI MANIA! -ログイン</title>

    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">


  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>ログイン</h1>
                <p class="text-muted">すでにご登録済みの方</p>
                <div class="alert"></div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="height:35px">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <form method="POST" action="backend/login_act.php">
                  <input class="form-control" type="text" name="user_name" placeholder="ユーザー名">
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input class="form-control" type="password" name="password" placeholder="パスワード">
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary px-4">ログイン</button>
                  </div>
                  
                  </form>
                  <div class="col-6 text-right">
                    <button type="submit" class="btn btn-link px-0" type="button">パスワードを忘れた方</button>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>新規登録</h2>
                  <p> 今すぐ挑戦！<br>OHORI MANIAを目指して頑張ろう！</p>
                  <a href="register.php"><button class="btn btn-primary active mt-3" type="button">登録する！</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/func.js"></script>
    <script>
      let st = getParam("st");
      switch (st) {
        case "lg_er":
          $('.alert').html('<span style="color:red">ログインに失敗しました。</span>');
          break;
        default:
          break;
      }
    </script>
  </body>
</html>

