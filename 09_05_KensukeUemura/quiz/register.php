<?php
session_start();
$sid = session_id();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>OHORI MANIA! -会員登録</title>

    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
              <h1>ようこそ！</h1>
              <p class="text-muted">以下の情報を入力して利用登録をしましょう。</p>
              <div class="alert"></div>
              <form method="POST" action="backend/insert.php">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                <input class="form-control" type="text" placeholder="ユーザー名（半角英数字）" name="user_name" required>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    ご希望のプラン
                  </span>
                </div>
                <select id="filterDimension" name="plan" class="pullDown">
                  <option value="null">プランを選んでください</option>
                  <option value="free">無料プラン</option>
                  <option value="silver">シルバープラン</option>
                  <option value="gold">ゴールドプラン</option>
              </select>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input class="form-control" type="text" placeholder="メールアドレス" name="email" required>
              </div>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-lock"></i>
                  </span>
                </div>
                <input class="form-control" type="password" placeholder="パスワード" name="password" required>
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-lock"></i>
                  </span>
                </div>
                <input class="form-control" type="password" placeholder="もう一度パスワードを入力" name="password2" required>
              </div>
              <button type="submit" class="btn btn-block btn-success" type="button">利用規約に同意して登録</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
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
