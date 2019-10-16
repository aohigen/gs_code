//////変数宣言領域//////
// じゃんけん機能のための変数
let jankenImg = null;
let mine = null;
let yours = null;
const winText = "あなたの勝利！クーポンをプレゼント";
const loseText = "残念！負けてしまいました…。";
const drawText = "あいこです！もう一回チャレンジしましょう！";
let n01 = null;

// じゃんけん分析用の変数定義
let times = localStorage.getItem('times') || null;
let win = localStorage.getItem('win') || null;
let draw = localStorage.getItem('draw') || null ;
let lose = localStorage.getItem('lose') || null;
let lastChoice = localStorage.getItem('lastChoice') || null;
let choicePath = localStorage.getItem('choicePath') || null;
let choiceArray = JSON.parse(localStorage.getItem('choiceArray')) || [];
let choiceCntArray = JSON.parse(localStorage.getItem('choiceCntArray')) || {choki:0,paa:0,guu:0};
let sameLast = false;
let sameLastTimes = 0;


//////アクショントリガー領域//////
// じゃんけん開始ボタンをスクロールで表示
$(window).on("scroll", function() {
  if ($(this).scrollTop() > 500) {
    $('.modalOpen').fadeIn();
  } else {
    $('.modalOpen').hide();
  }
});

// 自分の手を選択
$(".guuChoice").on("click",function(){
  mine = "guu";
  $(this).addClass("shadow");
  $(".chokiChoice").removeClass("shadow");
  $(".paaChoice").removeClass("shadow");
});
$(".chokiChoice").on("click",function(){
  mine = "choki";
  $(this).addClass("shadow");
  $(".guuChoice").removeClass("shadow");
  $(".paaChoice").removeClass("shadow");
});
$(".paaChoice").on("click",function(){
  mine = "paa";
  $(this).addClass("shadow");
  $(".guuChoice").removeClass("shadow");
  $(".chokiChoice").removeClass("shadow");
});

// 自分の選択した手を画像表示
$("#jankenDecide,#jankenDecide2").on("click",function(){
  $('.modal_box').fadeOut();
  modal = "#modalJanken"
  $(modal).fadeIn();
  modalResize();
  if(mine=="guu"){
    $('#myChoice').attr('src','img/guu.png');
    }else if(mine=="choki"){
    $('#myChoice').attr('src','img/choki.png');
    }else if(mine=="paa"){
    $('#myChoice').attr('src','img/paa.png');
    }
  })


//////関数領域//////
// モーダルを中央に寄せる関数
function modalResize(){
        let w = $(window).width();
        let h = $(window).height();
 
        let x = (w - $(modal).outerWidth(true)) / 2;
        let y = (h - $(modal).outerHeight(true)) / 2;
 
        $(modal).css({'left': x + 'px','top': y + 'px'});
    }

// じゃんけん履歴を集計
let addChoicePath = (s) => {
  if(lastChoice === s){ //前回と同じ手が続いているかをチェック
    sameLast = true;
    sameLastTimes++;
    localStorage.setItem('sameLast',sameLast);
    localStorage.setItem('sameLastTimes',sameLastTimes);
  }else{ //同じ手でなければ、同じ手フラグをリセット
    sameLastTimes = 0;
    localStorage.setItem('sameLast',false);
    localStorage.removeItem('sameLastTimes');
  }
  lastChoice = s; //今回の手を「前回の手」として保存
  localStorage.setItem('lastChoice',lastChoice);
  if(choicePath === null){ //最初の値がnullになってしまうので、回りくどいがif文で最初がnullにならないように調整
    choicePath = s;
  }else{ //履歴を追加
    choicePath += ' > ' + s;
  }
  localStorage.setItem('choicePath',choicePath);
  //配列でも履歴を保存。（配列と、連想配列）
  choiceArray.push(s);
  choiceCntArray[s]++;
  //jsonに変換
  localStorage.setItem('choiceArray',JSON.stringify(choiceArray));
  localStorage.setItem('choiceCntArray',JSON.stringify(choiceCntArray));
}

// 次の手を予想する関数
let jankenPredict = () => {
  if(sameLast === true){ //二回連続の時は、さすがに三回連続はないだろうと予測。残り二手で絶対に負けない方を選ぶ
    if(lastChoise === 'paa'){
      yours = 'guu';
    }else if(lastChoice === 'choki'){
      yours = 'paa';
   }else if(lastChoice === 'guu'){
      yours = 'choki';
    }
  }else{ //同じ手を連続では出しにくい。極端に選ばれていない手がある時にその手に対する勝ち手を選び、偏りがない時は残り二手から負けない方を選ぶ
    if(lastChoise === 'paa'){
      if(myGuu / times < 0.2){
        yours = 'paa'
      }else if(sameLastTimes / times < 0.2){
        yours = 'choki';
      }else{
        yours = 'guu';
      }
    }else if(lastChoice === 'choki'){
      if(myPaa / times < 0.2){
        yours = 'choki'
      }else if(sameLastTimes / times < 0.2){
        yours = 'guu';
      }else{
        yours = 'paa';
      }
   }else if(lastChoice === 'guu'){
    if(myChoki / times < 0.2){
        yours = 'guu'
      }else if(sameLastTimes / times < 0.2){
        yours = 'paa';
      }else{

        yours = 'choki';
      }
    }
  }
}

// スロット風表示の条件指定
  let option = {
		speed : 10,
		duration : 0.1,
    stopImageNumber : null,
	};

// 最初の表示画像を「？（デフォルト画像）」にする
$(function(){
  // initialize!
  $('div.roulette').roulette(option);
   });

//じゃんけんの開始
  $("#jankenStart").on("click",function(){
    n01 = Math.random();
    n01 = Math.ceil(Math.random()*3);
    if(n01 == 1){
    yours = "guu";
    option.stopImageNumber = 1;
  }else if(n01 == 2){
    yours = "choki";
    option.stopImageNumber = 2;
  }else if(n01 == 3){
    yours = "paa";
    option.stopImageNumber = 3;
  }else{
    alert("バグです！");
  }
  alert(mine+yours+option.stopImageNumber);
  $('div.roulette').roulette('start');
	});


$("#jankenStart").on("click",function(){
// じゃんけんの結果によって次のモーダルをコントロール
console.log(mine,yours);
  if(mine=="paa" && yours=="guu"){
    win++;
    localStorage.setItem('win',win);
    addChoicePath(mine);
    $('.modal_box').delay(3000).fadeOut();
    modal = "#modal2"
    $(modal).fadeIn();
    modalResize();
  }else if(mine=="paa" && yours=="choki"){
    lose++;
    localStorage.setItem('lose',lose);
    addChoicePath(mine);
    $('.modal_box').delay(3000).fadeOut();
    modal = "#modalLose"
    $(modal).fadeIn();
    modalResize();
  }else if(mine=="guu" && yours=="choki"){
    win++;
    localStorage.setItem('win',win);
    addChoicePath(mine);
    $('.modal_box').delay(3000).fadeOut();
    modal = "#modal2"
    $(modal).fadeIn();
    modalResize();
  }else if(mine=="guu" && yours=="paa"){
    lose++;
    localStorage.setItem('lose',lose);
    addChoicePath(mine);
    $('.modal_box').delay(3000).fadeOut();
    modal = "#modalLose"
    $(modal).fadeIn();
    modalResize();
  }else if(mine=="choki" && yours=="paa"){
    win++;
    localStorage.setItem('win',win);
    addChoicePath(mine);
    $('.modal_box').delay(3000).fadeOut();
    modal = "#modal2"
    $(modal).fadeIn();
    modalResize();
  }else if(mine=="choki" && yours=="guu"){
    lose++;
    localStorage.setItem('lose',lose);
    addChoicePath(mine);
    $('.modal_box').delay(3000).fadeOut();
    modal = "#modalLose"
    $(modal).fadeIn();
    modalResize();
  }else{
    draw++;
    n01 = null;
    localStorage.setItem('draw',draw);
    addChoicePath(mine);
    $('.modal_box').delay(3000).fadeOut();
    modal = "#modalDraw"
    $(modal).fadeIn();
    modalResize();
       }
      });



   
// クーポンスロット用の乱数を生成
let couponPrice = null;
let couponCode = null;
$("#slotStart").on("click",function(){
  let n02 = Math.random();
  n02 = Math.ceil(Math.random()*3);

  if(n02==1){
    $('.odometer').html(1000);
    couponPrice = "1000";
    couponCode = "XF9J76Gj";
    $('.modal_box').delay(3500).fadeOut();
    modal = "#modal3"
    $(modal).fadeIn();
    $(".couponPrice").text(couponPrice);
    $(".couponCode").text(couponCode);
    modalResize();
  }else if(n02==2){
    $('.odometer').html(2000);
    couponPrice = "2000";
    couponCode = "5Grd4FgT";
    $('.modal_box').delay(3500).fadeOut();
    modal = "#modal3"
    $(modal).fadeIn();
    $(".couponPrice").text(couponPrice);
    $(".couponCode").text(couponCode);
    modalResize();
  }else if(n02==3){
    $('.odometer').html(3000);
    couponPrice = "3000";
    couponCode = "K7HG6XF5";
    $('.modal_box').delay(3500).fadeOut();
    modal = "#modal3"
    $(modal).fadeIn();
    $(".couponPrice").text(couponPrice);
    $(".couponCode").text(couponCode);
    modalResize();
  }else{
    console.log("バグです！");
    }
  });