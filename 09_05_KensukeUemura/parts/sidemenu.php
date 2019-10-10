<div class="sidebar">
    <nav class="sidebar-nav">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="nav-icon icon-speedometer"></i> お知らせ
            <span class="badge badge-primary">NEW</span>
          </a>
        </li>
        <li class="nav-title" style="color:gray">クイズ</li>
        <li class="nav-item">
          <a class="nav-link" href="quiz.php">
            <i class="nav-icon icon-pencil"></i> 10問チャレンジ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="quiz_jigoku.php">
            <i class="nav-icon icon-drop"></i> 地獄モード</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="nav-icon icon-pencil"></i> 苦手な問題にトライ</a>
        </li>
        <li class="nav-title" style="color:gray">成績を見る</li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="">
            <i class="nav-icon icon-puzzle"></i> あなたの成績</a>
        </li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="">
            <i class="nav-icon icon-cursor"></i> みんなの成績</a>
        </li>
        <li class="nav-item mt-auto">
          <a class="nav-link nav-link-success" href="mypage.php" target="_top">
            <i class="nav-icon icon-cloud-download"></i>ユーザー情報を編集</a>
        </li>
        <?php
              if($user_info["admin_flg"] != 0){//管理者ユーザーの時のみユーザー管理画面へのリンクが表示
              echo('<li class="nav-item">
              <a class="nav-link nav-link-danger" href="admin.php" target="_top">
                <i class="nav-icon icon-layers"></i> ユーザー管理
              </a>
            </li>');
              }
            ?>
        <li class="nav-item">
              <a class="nav-link nav-link-dark" href="backend/logout.php" target="_top">
                <i class="nav-icon icon-layers"></i> ログアウト
              </a>
        </li>
      </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
  </div>