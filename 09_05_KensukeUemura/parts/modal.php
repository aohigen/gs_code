<div id="modal1" class="modal_box">
  <div id="header">
    <h1 class="quiz_result"></h1>

  </div>

  <div id="main">
    <div class="centerBox">
      <div>
        <h2>解説</h2>
        <p class="discription"></p>
      </div>
    </div>
    <div id="jankenStartBox"><!-- じゃんけん関数スタートボタン -->
      <a href="#" id="jankenDecide" class="jankenButtun">決定！</a>
    </div>
  </div>
</div>

<script>
let crct_flg = getParam("crflg");
let discription = <?=?>;
function modalResize(){
        let w = $(window).width();
        let h = $(window).height();
 
        let x = (w - $(modal).outerWidth(true)) / 2;
        let y = (h - $(modal).outerHeight(true)) / 2;
 
        $(modal).css({'left': x + 'px','top': y + 'px'});
    }
if(crct_flg == 1){
  $(.modal_box).fadeIn();
  $(.quiz_result).html("正解です！");
  4(.discription).html(discription);
    modalResize();
}else if(crct_flg == 0){
  $(.modal_box).fadeIn();
  $(.quiz_result).html("残念！");
  4(.discription).html("不正解です。もっと、大堀さんとお話しましょう！");
    modalResize();
}
</script>