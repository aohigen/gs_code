
    <form action="index.php" method="get">
        <span style="color:black">フィルタ：</span>
        <select id="filterDimension" name="dim" class="pullDown">
          <option value="null">未選択</option>
          <option value="prefecture">都道府県</option>
          <option value="zone">地方</option>
          <option value="age">年齢</option>
          <option value="year">西暦</option>
        </select>
        <select name="val" id="filterValue" class="pullDownVal">
          <option value="">条件を選んでください</option>
          <option value="北海道" class="selectPref">北海道</option>
          <option value="青森県" class="selectPref">青森</option>
          <option value="岩手県" class="selectPref">岩手</option>
          <option value="秋田県" class="selectPref">秋田</option>
          <option value="宮城県" class="selectPref">宮城</option>
          <option value="福島県" class="selectPref">福島</option>
          <option value="茨城県" class="selectPref">茨城</option>
          <option value="栃木県" class="selectPref">栃木</option>
          <option value="群馬県" class="selectPref">群馬</option>
          <option value="千葉県" class="selectPref">千葉</option>
          <option value="埼玉県" class="selectPref">埼玉</option>
          <option value="神奈川県" class="selectPref">神奈川</option>
          <option value="東京都" class="selectPref">東京</option>
          <option value="山梨県" class="selectPref">山梨</option>
          <option value="静岡県" class="selectPref">静岡</option>
          <option value="長野県" class="selectPref">長野</option>
          <option value="新潟県" class="selectPref">新潟</option>
          <option value="富山県" class="selectPref">富山</option>
          <option value="石川県" class="selectPref">石川</option>
          <option value="福井県" class="selectPref">福井</option>
          <option value="岐阜県" class="selectPref">岐阜</option>
          <option value="愛知県" class="selectPref">愛知</option>
          <option value="三重県" class="selectPref">三重</option>
          <option value="滋賀県" class="selectPref">滋賀</option>
          <option value="京都府" class="selectPref">京都</option>
          <option value="大阪府" class="selectPref">大阪</option>
          <option value="兵庫県" class="selectPref">兵庫</option>
          <option value="奈良県" class="selectPref">奈良</option>
          <option value="和歌山県" class="selectPref">和歌山</option>
          <option value="島根県" class="selectPref">島根</option>
          <option value="鳥取県" class="selectPref">鳥取</option>
          <option value="岡山県" class="selectPref">岡山</option>
          <option value="広島県" class="selectPref">広島</option>
          <option value="山口県" class="selectPref">山口</option>
          <option value="徳島県" class="selectPref">徳島</option>
          <option value="香川県" class="selectPref">香川</option>
          <option value="高知県" class="selectPref">高知</option>
          <option value="愛媛県" class="selectPref">愛媛</option>
          <option value="福岡県" class="selectPref">福岡</option>
          <option value="佐賀県" class="selectPref">佐賀</option>
          <option value="長崎県" class="selectPref">長崎</option>
          <option value="大分県" class="selectPref">大分</option>
          <option value="熊本県" class="selectPref">熊本</option>
          <option value="宮崎県" class="selectPref">宮崎</option>
          <option value="鹿児島県" class="selectPref">鹿児島</option>
          <option value="沖縄県" class="selectPref">沖縄</option>
          <option value="北海道・東北" class="selectZone">北海道・東北</option>
          <option value="関東" class="selectZone">関東</option>
          <option value="中部" class="selectZone">中部</option>
          <option value="関西" class="selectZone">関西</option>
          <option value="中国・四国" class="selectZone">中国・四国</option>
          <option value="九州・沖縄" class="selectZone">九州・沖縄</option>
          <option value="総数" class="selectAge">全年代</option>
          <option value="0〜5歳" class="selectAge">0~5歳</option>
          <option value="6~15歳" class="selectAge">6~15歳</option>
          <option value="15~20歳" class="selectAge">16~20歳</option>
          <option value="20代" class="selectAge">20代</option>
          <option value="30代" class="selectAge">30代</option>
          <option value="40代" class="selectAge">40代</option>
          <option value="50代" class="selectAge">50代</option>
          <option value="60代" class="selectAge">60代</option>
          <option value="70代" class="selectAge">70代</option>
          <option value="80歳以上" class="selectAge">80歳以上</option>

        </select>
      <input type="number" name="val2" class="inputVal" style="width:80px; display:none">
        <select name="match" id="filterMatchType">
          <option value="=">等しい</option>
          <option value=">=" class="selectMTnumber">以上</option>
          <option value="<=" class="selectMTnumber">以下</option>
          <option value=">" class="selectMTnumber">より大きい</option>
          <option value="<" class="selectMTnumber">より小さい</option>
          <option value="!=">等しくない</option>
        </select> 
       　<input type="submit" value="絞り込む" id="filterBtn">
    </form>　
    <span class="advanceFilterBtn" style="font-size:80%;margin:5px">アドバンスフィルタ</span>

