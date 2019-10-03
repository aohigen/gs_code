<?php
//関数群を読み込む
include("funcs.php");

//ユーザー情報を取得
$user_name = "kensuke";
//セグメントルールの取得
$filterDim = h($_GET["dim"]);
if($_GET["val"]){
  $filterVal = h($_GET["val"]);//プルダウンはあくまで非表示なので、一度選択してから西暦を選んでも、残ってしまう点は追って修正
}elseif($_GET["val2"]){
  $filterVal = h($_GET["val2"]);
}
$filterMatchType = h($_GET["match"]);

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
//SQLの各項目をコントロールしやすいように変数化
$sqlSelect = "year,sum(population),sum(men_pop),sum(women_pop)";
$sqlFrom = "population2";
if($filterDim == null || $filterVal == null){
  $sqlWhereDim = 'age';
  $sqlWhereVal = '"総数"';
}else{
  $sqlWhereDim = $filterDim;
  $sqlWhereVal = '"'.$filterVal.'"';
}

// EXIT($filterMatchType);
if(!empty($filterMatchType)){
  $sqlWhere = $sqlWhereDim.$filterMatchType.$sqlWhereVal;
  }else{
  $sqlWhere = $sqlWhereDim."=".$sqlWhereVal;
  }


$sqlGroupby = "year";
$sqlReqest = "SELECT $sqlSelect FROM $sqlFrom WHERE $sqlWhere GROUP BY $sqlGroupby";
//DBからデータを取得（SQLを変数化して代入するのは自己流）
$stmt = $pdo->prepare("$sqlReqest");
$status = $stmt->execute();

//データを表示する
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLエラー:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる（定番の書き方なので細かく知る必要なし）
  while( $r[] = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $json = json_encode($r);
  }
}

//SQLの各項目をコントロールしやすいように配列に
//都道府県
$stmt = $pdo->prepare("SELECT distinct(prefecture) FROM population2");
$status = $stmt->execute();
if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQLエラー:".$error[2]);
}else{
  while( $r2[] = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $jsonPref = json_encode($r2);
  }
}
//年齢
$stmt = $pdo->prepare("SELECT distinct(age) FROM population2");
$status = $stmt->execute();
if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQLエラー:".$error[2]);
}else{
  while( $r3[] = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $jsonAge = json_encode($r3);
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
    <title>JapanAnalytics</title>
    <!-- Icons-->
    <link href="css/style.css" rel="stylesheet">
    <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
  </head>

  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <!-- ヘッダーを外部ファイル化 -->
    <?php include("parts/header.php");?>
    <div class="app-body">
      <!-- サイドメニューを外部ファイル化 -->
      <?php include("parts/sidemenu.php");?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
        <a href="data/population.csv">CSVダウンロード</a>
        <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
            <?php
              if($user_info["plan"] !== 'free'){//無料プランの場合は表示しない
              //フィルターが長いので外部ファイル化
              include("parts/filter.php");
              }
            ?>
            </div>
          </li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
          <div class="card-columns cols-2">
              <div class="card">
                <div class="card-header">男女比
                  <div class="card-header-actions">
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">
                    <canvas id="canvas-1"></canvas>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">Bar Chart
                  <div class="card-header-actions">
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">
                    <canvas id="canvas-2"></canvas>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">Doughnut Chart
                  <div class="card-header-actions">
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">
                    <canvas id="canvas-3"></canvas>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">Radar Chart
                  <div class="card-header-actions">
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">
                    <canvas id="canvas-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">Pie Chart
                  <div class="card-header-actions">
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">
                    <canvas id="canvas-5"></canvas>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">Polar Area Chart
                  <div class="card-header-actions">
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">
                    <canvas id="canvas-6"></canvas>
                  </div>
                </div>
              </div>
            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<!-- グラフ描写用 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script>
//確認用コンソール
let db = JSON.parse('<?=$json?>');
let prefArray = JSON.parse('<?=$jsonPref?>');
let ageArray = JSON.parse('<?=$jsonAge?>');
//変数一式
let yearArray = [];
let popArray =[];
let menPopArray = [];
let womenPopArray = [];
let womenRateArray = [];
let growthRateArray = [1];
let menGrowthRateArray = [1];
let womenGrowthRateArray = [1];
let menPopSum = 0;
let womenPopSum = 0;

for(i=0;i<db.length;i++){
  yearArray.push(db[i]["year"]);
  popArray.push(Number(db[i]["sum(population)"]));
  menPopArray.push(Number(db[i]["sum(men_pop)"]));
  womenPopArray.push(Number(db[i]["sum(women_pop)"]));
  womenRateArray.push(Number(db[i]["sum(women_pop)"]/db[i]["sum(population)"]));
  menPopSum += menPopArray[i];
  womenPopSum += womenPopArray[i];
  if(i+1 < db.length){
    growthRateArray.push(Number(db[i+1]["sum(population)"]/db[i]["sum(population)"]).toFixed(2));
    menGrowthRateArray.push(Number(db[i+1]["sum(men_pop)"]/db[i]["sum(men_pop)"]).toFixed(2));
    womenGrowthRateArray.push(Number(db[i+1]["sum(women_pop)"]/db[i]["sum(women_pop)"]).toFixed(2));
  }
}
let menPopAvg = menPopSum / menPopArray.length;
let womenPopAvg = womenPopSum / womenPopArray.length;
console.log("あひ",menPopAvg,womenPopAvg);

// 配列を元に主要指標を算出
let maxPop = Math.max.apply(null,popArray);//最大人口
let minPop = Math.min.apply(null,popArray);//最小人口
let recentPop = popArray[popArray.length-1];
let maxRate = popArray[popArray.length-1]/maxPop*100;//最大値比
let lastRate = recentPop/popArray[popArray.length-2]*100;
let recentWomenRate = womenPopArray[womenPopArray.length-1]/popArray[popArray.length-1]*100;//直近の女性率
let _10yNum = popArray[popArray.length-3];
let _20yNum = popArray[popArray.length-5];
let _50yNum = popArray[popArray.length-11];
let _75yNum = popArray[popArray.length-16];
let startNum = popArray[0];
let _10yRate = recentPop/_10yNum*100;
let _20yRate = recentPop/_20yNum*100;
let _50yRate = recentPop/_50yNum*100;
let _75yRate = recentPop/_75yNum*100;;
let startRate = recentPop/startNum*100;

//各要素にテキストを代入
$('.reportTerm').html(yearArray[0]+'年 - '+yearArray[yearArray.length-1]+'年');
$('.recentPop').html(recentPop.toLocaleString());//直近の総人口
$('.lastRate').html(lastRate.toFixed(2)+'%');
$('.maxRate').html(maxRate.toFixed(2)+'%');
$('.recentWomenRate').html(recentWomenRate.toFixed(2)+'%');
//フッターカードへの入力
$('.10yNum').html((recentPop-_10yNum).toLocaleString());
$('.10yRate').html(_10yRate.toFixed(1));
$('.20yNum').html((recentPop-_20yNum).toLocaleString());
$('.20yRate').html(_20yRate.toFixed(1));
$('.50yNum').html((recentPop-_50yNum).toLocaleString());
$('.50yRate').html(_50yRate.toFixed(1));
$('.75yNum').html((recentPop-_75yNum).toLocaleString());
$('.75yRate').html(_75yRate.toFixed(1));
$('.startNum').html((recentPop-startNum).toLocaleString());
$('.startRate').html(startRate.toFixed(1));
$('.10yNumBar').css('width',_10yRate/2);
$('.20yNumBar').css('width',_20yRate/2);
$('.50yNumBar').css('width',_50yRate/2);
$('.75yNumBar').css('width',_75yRate/2);
$('.startNumBar').css('width',startRate/2);

//チャート領域
let ctx = document.getElementById("canvas-1").getContext('2d');
let popChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["女性","男性"],
    datasets: [{
      backgroundColor: [
        "#ff69b4",
        "#4169e1"
      ],
      data: [womenPopAvg, menPopAvg]
    }]
  },
    options: {}
});

//カードチャート１
// let ctx2 = document.getElementById("card-chart1").getContext('2d');
// let menPopChart = new Chart(ctx2, {
//   type: 'line',
//   data: {
//     labels: yearArray,
//     datasets: [{
//       label: '総人口',
//       data: menPopArray,
//       backgroundColor: 'rgba(60, 160, 220, 0.3)',
//       borderColor: 'rgba(60, 160, 220, 0.8)'
//     }],
//   },
//     options: {
//       legend: { // 「緑」「オレンジ」の非表示
//         display: false,
//       },
//       ticks: { // 「緑」「オレンジ」の非表示
//         display: false,
//       },
//       gridLines: {
//         display:false
//       }
//     }
// });

//フィルタの表示用
$('[name=dim]').change(function(){
  switch($('#filterDimension').val()){
    case "prefecture":
    $('.pullDownVal').show();
    $('.selectAge').hide();
    $('.selectPref').show();
    $('.inputVal').hide();
    $('.selectMTnumber').hide();
    break;
    case "age":
    $('.pullDownVal').show();
    $('.selectPref').hide();
    $('.selectAge').show();
    $('.inputVal').hide();
    $('.selectMTnumber').hide();
    break;
    case "year":
    $('.pullDownVal').hide();
    $('.inputVal').show();
    $('.selectMTnumber').show();
    break;
    default:
    $('.pullDownVal').show();
    $('.selectPref').hide();
    $('.selectAge').hide();
    $('.inputVal').hide();
  }
});

$('#metrixGrowthRate').on('click',function(){
  popChart.data.datasets[0].data = growthRateArray;
  popChart.data.datasets[1].data = menGrowthRateArray;
  popChart.data.datasets[2].data = womenGrowthRateArray;
  popChart.update();
  $('.metrixGrowthRate').addClass('active');
  $('.metrixNumber').removeClass('active');
});

$('#metrixNumber').on('click',function(){
  popChart.data.datasets[0].data = popArray;
  popChart.data.datasets[1].data = menPopArray;
  popChart.data.datasets[2].data = womenPopArray;
  popChart.update();
  $('.metrixNumber').addClass('active');
  $('.metrixGrowthRate').removeClass('active');
});


</script>

  </body>
</html>
