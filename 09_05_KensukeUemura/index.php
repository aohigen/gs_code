<?php
session_start();
include("funcs.php");
login_check();

//DB接続関数の実行
$pdo = db_conn();

//全ユーザー数の取得
$sqlReqest = "SELECT COUNT('user_id') as num FROM user_table";
$stmt = $pdo->prepare("$sqlReqest");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  $user_num = $stmt->fetch(PDO::FETCH_ASSOC);
}

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


//ユーザーの回答履歴を取得
$stmt = $pdo->prepare("SELECT * FROM answers WHERE user_id='$user_id' ORDER BY answer_time ASC");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  while( $r[] = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $json_answers = json_encode($r);
  }
}

//カテゴリごとの回答を取得
$stmt = $pdo->prepare("SELECT * FROM answers WHERE user_id='$user_id' ORDER BY answer_time ASC");
$status = $stmt->execute();
if($status==false) {
  sql_error();
}else{
  while( $r[] = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $json_answers = json_encode($r);
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
    <title>OHORI MANIA!</title>
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
        <!-- <a href="data/population2.csv">CSVダウンロード</a>　 -->
        <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
            <!-- ここがフィルタが入ってた場所 -->
            </div>
          </li>
        </ol>


        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value recentPop"><?=$user_rank?>位 <span style="font-size:70%">（<?=$user_num['num']?>人中）</span></div>
                    <div>あなたの順位</div>
                  </div>
                  <div class="chart-wrapper mt-3 mx-3" style="height:5px;">
                    <!-- <canvas class="chart" id="card-chart1" height="70"></canvas> -->
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-info">
                  <div class="card-body pb-0">
                    <button class="btn btn-transparent p-0 float-right" type="button">
                      <i class="icon-location-pin"></i>
                    </button>
                    <div class="text-value lastRate"><?=$crct_rate?>%</div>
                    <div>正答率</div>
                  </div>
                  <div class="chart-wrapper mt-3 mx-3" style="height:5px;">
                    <!-- <canvas class="chart" id="card-chart2" height="70"></canvas> -->
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-warning">
                  <div class="card-body pb-0">

                    <div class="text-value maxRate"><?=$user_info['answer_times']?></div>
                    <div>総回答数</div>
                  </div>
                  <div class="chart-wrapper mt-3" style="height:5px;">
                    <!-- <canvas class="chart" id="card-chart3" height="70"></canvas> -->
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-danger">
                  <div class="card-body pb-0">
                    <div class="text-value recentWomenRate"><?=$user_info['quiz_times']?></div>
                    <div>クイズ挑戦数</div>
                  </div>
                  <div class="chart-wrapper mt-3 mx-3" style="height:5px;">
                    <!-- <canvas class="chart" id="card-chart4" height="70"></canvas> -->
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                    <h4 class="card-title mb-0">成績の推移</h4>
                    <div class="small text-muted reportTerm"></div><span class="activeFilter" style="font-size:80%"></span>
                  </div>
                  <!-- /.col-->
                  <div class="col-sm-7 d-none d-md-block">
                    <button class="btn btn-primary float-right" type="button">
                    期間
                    </button>
                    <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                      <label class="btn btn-outline-secondary metrixNumber active">
                        <input id="metrixNumber" type="radio" name="options" autocomplete="off" checked=""> 正答率
                      </label>
                      <label class="btn btn-outline-secondary metrixGrowthRate">
                        <input id="metrixGrowthRate" type="radio" name="options" autocomplete="off" checked=""> 正答数
                      </label>
                    </div>
                  </div>
                  <!-- /.col-->
                </div>
                <!-- /.row-->
                <div class="chart-wrapper" style="height:auto;margin-top:10px;">
                  <canvas id="popChart" class="chartSize" height="340"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="row text-center">
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">知ってて当たり前の大堀</div>
                    <strong><span class="10yNum"></span>   <br>(<span class="10yRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-info 10yNumBar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">大堀の歴史</div>
                    <strong><span class="20yNum"></span>  人 <br>(<span class="20yRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-warning 20yNumBar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">知られざる大堀</div>
                    <strong><span class="50yNum"></span>  人 <br>(<span class="50yRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-danger 50yNumBar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">G'sでの大堀</div>
                    <strong><span class="75yNum"></span> 人 <br>(<span class="75yRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-success 75yNumBar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
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
            <!-- /.row-->
          

                </div>
              </div>
            </div>

          </div>
        </div>
      </main>
      
    </div>
    <?php include("parts/footer.php");?>
    <!-- CoreUI and necessary plugins-->


<!-- ここよりJavaScript領域 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<!-- グラフ描写用 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script>
//確認用コンソール
let myAnswerArray = JSON.parse('<?=$json_answers?>');

//変数一式
let graghAnswers = [];
let crctAnswerNum =0;
let crctAnswerArray = [];
let crctRateArray = [];

for(i=0;i<myAnswerArray.length;i++){
  graghAnswers.push(i+1);
  crctAnswerNum += Number(myAnswerArray[i]["crct_flg"]);
  crctAnswerArray.push(crctAnswerNum);
  crctRateArray.push(Number(myAnswerArray[i]["crct_amount"]/myAnswerArray[i]["answer_amount"]).toFixed(2));
  console.log(crctRateArray,crctAnswerArray,graghAnswers);
}


//チャート領域
let ctx = document.getElementById("popChart").getContext('2d');
let popChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: graghAnswers,
    datasets: [{
      label: '累計の正答率',
      data: crctRateArray,
      backgroundColor: 'rgba(60, 160, 220, 0.3)',
      borderColor: 'rgba(60, 160, 220, 0.8)'
    // }, {
    //   label: 'あなた',
    //   data: menPopArray,
    //   backgroundColor: 'rgba(60, 190, 20, 0.3)',
    //   borderColor: 'rgba(60, 190, 20, 0.8)'
    // }, {
    //   label: '全体平均',
    //   data: womenPopArray,
    //   backgroundColor: 'rgba(255, 100, 170, 0.3)',
    //   borderColor: 'rgba(200, 50, 120, 0.8)'
    }],
  },
    options: {}
});



$('#metrixGrowthRate').on('click',function(){
  popChart.data.datasets[0].data = crctAnswerArray;
  // popChart.data.datasets[1].data = menGrowthRateArray;
  // popChart.data.datasets[2].data = womenGrowthRateArray;
  popChart.update();
  $('.metrixGrowthRate').addClass('active');
  $('.metrixNumber').removeClass('active');
});

$('#metrixNumber').on('click',function(){
  popChart.data.datasets[0].data = crctRateArray;
  // popChart.data.datasets[1].data = menPopArray;
  // popChart.data.datasets[2].data = womenPopArray;
  popChart.update();
  $('.metrixNumber').addClass('active');
  $('.metrixGrowthRate').removeClass('active');
});

//フィルタがかかっていたら文字列を挿入
// let filterRule = location.search||null;
// let filterDim = '<?=$filterDim?>';
// let filterMatchType = '<?=$filterMatchType?>';
// let filterVal = '<?=$filterVal?>';

if(filterRule == null){
  $('.activeFilter').hide();
  filterRule = null;
}else{
  $('#filterDimension option[value="'+filterDim+'"]').attr('selected','selected');
  $('#filterValue option[value="'+filterVal+'"]').attr('selected','selected');
  $('#filterMatchType option[value="'+filterMatchType+'"]').attr('selected','selected');
  let v;
  switch(filterDim){
    case 'prefecture':
      v = '都道府県';
      break;
    case 'zone':
      v = '地方';
      break;
      case 'age':
      v = '年齢';
      break;
    case 'year':
      v = '西暦';
      break;
  }
  $('.activeFilter').show();
  $('.activeFilter').html('<p style="color:red">フィルターが有効：'+v+' '+filterMatchType+' '+filterVal+'　<a href="index.php" style="font-size:80%;color:blue">クリアする</a></p>');
  filterRule = null;
}
</script>

</body>
</html>
