<div class="sidebar">
    <nav class="sidebar-nav">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="nav-icon icon-speedometer"></i> お知らせ
            <span class="badge badge-primary">NEW</span>
          </a>
        </li>
        <li class="nav-title" style="color:gray">人口データ</li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="nav-icon icon-drop"></i> トレンド</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="chart.php">
            <i class="nav-icon icon-pencil"></i> 詳細データ</a>
        </li>
        <li class="nav-title" style="color:gray">その他のデータ</li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="">
            <i class="nav-icon icon-puzzle"></i> 犯罪率</a>
        </li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="">
            <i class="nav-icon icon-cursor"></i> 国民総生産</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="nav-icon icon-pie-chart"></i> 就業度</a>
        </li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="">
            <i class="nav-icon icon-star"></i> 税収</a>
        </li>
        <li class="nav-item mt-auto">
          <a class="nav-link nav-link-success" href="mypage.php" target="_top">
            <i class="nav-icon icon-cloud-download"></i>マイページ</a>
        </li>
        <?php
              if($user_info["admin_flg"] == 1){//管理者ユーザーの時のみユーザー管理画面へのリンクが表示
              echo('<li class="nav-item">
              <a class="nav-link nav-link-danger" href="admin.php" target="_top">
                <i class="nav-icon icon-layers"></i> ユーザー管理
              </a>
            </li>');
              }
            ?>
      </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
  </div>