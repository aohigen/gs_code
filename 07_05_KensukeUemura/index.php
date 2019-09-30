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

//分析データの取得
$sqlSelect = "year,sum(population),sum(men_pop),sum(women_pop)";
$sqlFrom = "population2";
if($filterDim == null || $filterVal == null){
  $sqlWhereDim = 'age';
  $sqlWhereVal = '"総数"';
}else{
  $sqlWhereDim = $filterDim;
  $sqlWhereVal = '"'.$filterVal.'"';
}

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
  sql_error();
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
        <a href="data/population2.csv">CSVダウンロード</a>　
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
      
        <div class="card advanceFilter">
            <div class="card-body">
              <?php
                include("parts/adv_filter.php");//アドバンスフィルタを外部ファイル化
              ?>
            </div>
        </div>
        




        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value recentPop"></div>
                    <div>最新の総人口</div>
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
                    <div class="text-value lastRate"></div>
                    <div>前回比</div>
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

                    <div class="text-value maxRate"></div>
                    <div>最大値比</div>
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
                    <div class="text-value recentWomenRate"></div>
                    <div>女性率</div>
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
                    <h4 class="card-title mb-0">人口の変化</h4>
                    <div class="small text-muted reportTerm"></div><span class="activeFilter" style="font-size:80%"></span>
                  </div>
                  <!-- /.col-->
                  <div class="col-sm-7 d-none d-md-block">
                    <button class="btn btn-primary float-right" type="button">
                    期間
                    </button>
                    <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                      <label class="btn btn-outline-secondary metrixNumber active">
                        <input id="metrixNumber" type="radio" name="options" autocomplete="off" checked=""> 人数
                      </label>
                      <label class="btn btn-outline-secondary metrixGrowthRate">
                        <input id="metrixGrowthRate" type="radio" name="options" autocomplete="off" checked=""> 成長率
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
                    <div class="text-muted">10年前比</div>
                    <strong><span class="10yNum"></span>  人 <br>(<span class="10yRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-info 10yNumBar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">20年前比</div>
                    <strong><span class="20yNum"></span>  人 <br>(<span class="20yRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-warning 20yNumBar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">50年前比</div>
                    <strong><span class="50yNum"></span>  人 <br>(<span class="50yRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-danger 50yNumBar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">75年前比</div>
                    <strong><span class="75yNum"></span> 人 <br>(<span class="75yRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-success 75yNumBar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">初回調査比</div>
                    <strong><span class="startNum"></span>  人 <br>(<span class="startRate"></span>%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar startNumBar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
                <!-- <table style="margin:20px 20px 20px 20px">
                <tr><th>西暦</th><th>総人口</th><th>男性</th><th>女性</th><th>女性率</th></tr>
                <span class="dataList"></span>
                </table> -->

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

for(i=0;i<db.length;i++){
  yearArray.push(db[i]["year"]);
  popArray.push(Number(db[i]["sum(population)"]));
  menPopArray.push(Number(db[i]["sum(men_pop)"]));
  womenPopArray.push(Number(db[i]["sum(women_pop)"]));
  womenRateArray.push(Number(db[i]["sum(women_pop)"]/db[i]["sum(population)"]));
  if(i+1 < db.length){
    growthRateArray.push(Number(db[i+1]["sum(population)"]/db[i]["sum(population)"]).toFixed(2));
    menGrowthRateArray.push(Number(db[i+1]["sum(men_pop)"]/db[i]["sum(men_pop)"]).toFixed(2));
    womenGrowthRateArray.push(Number(db[i+1]["sum(women_pop)"]/db[i]["sum(women_pop)"]).toFixed(2));
  }
}

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
let ctx = document.getElementById("popChart").getContext('2d');
let popChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: yearArray,
    datasets: [{
      label: '総人口',
      data: popArray,
      backgroundColor: 'rgba(60, 160, 220, 0.3)',
      borderColor: 'rgba(60, 160, 220, 0.8)'
    }, {
      label: '男性',
      data: menPopArray,
      backgroundColor: 'rgba(60, 190, 20, 0.3)',
      borderColor: 'rgba(60, 190, 20, 0.8)'
    }, {
      label: '女性',
      data: womenPopArray,
      backgroundColor: 'rgba(255, 100, 170, 0.3)',
      borderColor: 'rgba(200, 50, 120, 0.8)'
    }],
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
    $('.zone').hide();
    $('.selectAge').hide();
    $('.selectPref').show();
    $('.inputVal').hide();
    $('.selectMTnumber').hide();
    break;
    case "zone":
    $('.pullDownVal').show();
    $('.selectZone').show();
    $('.selectAge').hide();
    $('.selectPref').hide();
    $('.inputVal').hide();
    $('.selectMTnumber').hide();
    break;
    case "age":
    $('.pullDownVal').show();
    $('.selectPref').hide();
    $('.selectZone').hide();
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

//フィルタがかかっていたら文字列を挿入
let filterRule = location.search||null;
let filterDim = '<?=$filterDim?>';
let filterMatchType = '<?=$filterMatchType?>';
let filterVal = '<?=$filterVal?>';
if(filterRule == null){
  $('.activeFilter').hide();
  filterRule = null;
}else{
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

$('.addFilter').on('click',function(){
  $('.additionalRule').append('<select id="filterDimension" name="dim" class="pullDown"> <option value="null">未選択</option><option value="prefecture">都道府県</option><option value="zone">地方</option><option value="age">年齢</option><option value="year">西暦</option></select><select name="val" id="filterValue" class="pullDownVal"><option value="">条件を選んでください</option><option value="北海道" class="selectPref">北海道</option><option value="青森県" class="selectPref">青森</option><option value="岩手県" class="selectPref">岩手</option><option value="秋田県" class="selectPref">秋田</option><option value="宮城県" class="selectPref">宮城</option><option value="福島県" class="selectPref">福島</option><option value="茨城県" class="selectPref">茨城</option><option value="栃木県" class="selectPref">栃木</option><option value="群馬県" class="selectPref">群馬</option><option value="千葉県" class="selectPref">千葉</option><option value="埼玉県" class="selectPref">埼玉</option><option value="神奈川県" class="selectPref">神奈川</option><option value="東京都" class="selectPref">東京</option><option value="山梨県" class="selectPref">山梨</option><option value="静岡県" class="selectPref">静岡</option><option value="長野県" class="selectPref">長野</option><option value="新潟県" class="selectPref">新潟</option><option value="富山県" class="selectPref">富山</option><option value="石川県" class="selectPref">石川</option><option value="福井県" class="selectPref">福井</option><option value="岐阜県" class="selectPref">岐阜</option><option value="愛知県" class="selectPref">愛知</option><option value="三重県" class="selectPref">三重</option><option value="滋賀県" class="selectPref">滋賀</option><option value="京都府" class="selectPref">京都</option><option value="大阪府" class="selectPref">大阪</option><option value="兵庫県" class="selectPref">兵庫</option><option value="奈良県" class="selectPref">奈良</option><option value="和歌山県" class="selectPref">和歌山</option><option value="島根県" class="selectPref">島根</option><option value="鳥取県" class="selectPref">鳥取</option><option value="岡山県" class="selectPref">岡山</option><option value="広島県" class="selectPref">広島</option><option value="山口県" class="selectPref">山口</option><option value="徳島県" class="selectPref">徳島</option><option value="香川県" class="selectPref">香川</option><option value="高知県" class="selectPref">高知</option><option value="愛媛県" class="selectPref">愛媛</option><option value="福岡県" class="selectPref">福岡</option><option value="佐賀県" class="selectPref">佐賀</option><option value="長崎県" class="selectPref">長崎</option><option value="大分県" class="selectPref">大分</option><option value="熊本県" class="selectPref">熊本</option><option value="宮崎県" class="selectPref">宮崎</option><option value="鹿児島県" class="selectPref">鹿児島</option><option value="沖縄県" class="selectPref">沖縄</option><option value="北海道・東北" class="selectZone">北海道・東北</option><option value="関東" class="selectZone">関東</option><option value="中部" class="selectZone">中部</option><option value="関西" class="selectZone">関西</option><option value="中国・四国" class="selectZone">中国・四国</option><option value="九州・沖縄" class="selectZone">九州・沖縄</option><option value="総数" class="selectAge">全年代</option><option value="0〜5歳" class="selectAge">0~5歳</option><option value="6~15歳" class="selectAge">6~15歳</option><option value="15~20歳" class="selectAge">16~20歳</option><option value="20代" class="selectAge">20代</option><option value="30代" class="selectAge">30代</option><option value="40代" class="selectAge">40代</option><option value="50代" class="selectAge">50代</option><option value="60代" class="selectAge">60代</option><option value="70代" class="selectAge">70代</option><option value="80歳以上" class="selectAge">80歳以上</option></select><input type="number" name="val2" class="inputVal" style="width:80px; display:none"><select name="match" id="filterMatchType"><option value="=">等しい</option><option value=">=" class="selectMTnumber">以上</option><option value="<=" class="selectMTnumber">以下</option><option value=">" class="selectMTnumber">より大きい</option><option value="<" class="selectMTnumber">より小さい</option><option value="!=">等しくない</option></select><br><br>');
});

//アドバンスフィルター
$('.advanceFilter').hide(); //デフォルトでは隠す
$('.advanceFilterBtn').on('click',function(){
  $('.advanceFilter').show();
});

//グラフの下に表を挿入
for(i=0;i<yearArray.length;i++){
  $('.dataList').append('<tr><td>'+yearArray[i]+'年</td><td>'+popArray[i].toLocaleString()+'</td><td>'+menPopArray[i].toLocaleString()+'</td><td>'+womenPopArray[i].toLocaleString()+'</td><td>'+(womenRateArray[i]*100).toFixed(1)+'%'+'</td></tr>');
console.log("表ぐみ：",yearArray[i]);
}

</script>

  </body>
</html>
