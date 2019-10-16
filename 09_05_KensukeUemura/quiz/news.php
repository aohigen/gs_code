<?php
session_start();
include("funcs.php");
login_check();



//DB接続関数の実行
$pdo = db_conn();
//ユーザー情報の取得
// $stmt = $pdo->prepare("SELECT crct_times , RANK() OVER(ORDER BY crct_times DESC) FROM user_table");
$stmt = $pdo->prepare("SELECT * ,crct_times/answer_times rate, (SELECT COUNT(DISTINCT crct_times/answer_times) FROM user_table b WHERE a.crct_times/answer_times < b.crct_times/answer_times) + 1 rank FROM user_table a WHERE user_name='$user_name'");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
}
$crct_rate = round($user_info['crct_times']/$user_info['answer_times']*100,2);
$user_rank = $user_info['rank'];
$user_id = $user_info['user_id'];

//最新情報の取得
$sqlReqest = "SELECT date,category,discription,user_name FROM news INNER JOIN user_table ON news.user_id = user_table.user_id ORDER BY date DESC LIMIT 20";
$stmt = $pdo->prepare("$sqlReqest");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  while( $r[] = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $json_news = json_encode($r);
}
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
    <title>OHORI MANIA! -最新情報</title>
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
                    <h4 class="card-title mb-0">ニュース</h4>
                  </div>
                </div>
                <!-- /.row-->
                <div class="chart-wrapper" style="height:auto;margin-top:10px;">
                <div class="card mx-4">
            <div class="card-body p-4" style="width:100%">
              <h1>最新のアクティビティ</h1>
              <div class="alert"></div>
              <table class="table table-responsive-sm" style="width:100%">
                      <thead>
                        <tr>
                          <th>日付</th>
                          <th>種別</th>
                          <th>内容</th>
                        </tr>
                      </thead>
                      <tbody class="news-list">
                      </tbody>
                    </table>
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
let newsArray = JSON.parse('<?=$json_news?>');
console.log(newsArray);
let badgeClass;
for(i=0;i<newsArray.length;i++){
  if(newsArray[i].category=="クイズ作成"){
    badgeClass = "badge-danger";
  }else if(newsArray[i].category=="クイズ回答"){
    badgeClass = "badge-success";
  }
  $('.news-list').append('<tr><td>'+newsArray[i].date+'</td><td><span class="badge '+badgeClass+'">'+newsArray[i].category+'</span></td><td><span style="color:#20a8d8">'+newsArray[i].user_name+'</span>さんが、'+newsArray[i].discription+'</td></tr>');
}
</script>


  </body>
</html>