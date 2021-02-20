<!-- ヘッダー -->
<nav id="top" class="navbar navbar-expand-lg navbar-light bg-white shadow">
  <!-- sticky-top -->
  <a class="navbar-brand" href="top.php"><img src="img/logo-wide_white.jpeg" alt="ロゴ" style="height: 80px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <div class="nav-link text-center" style="color: rgba(0,0,0,.5);">ようこそ、<?=$_SESSION['User']['last_name'] ?>様</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-center" href="mypage.php">マイページ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-center" href="?logout=1">ログアウト</a>
      </li>
    </ul>
  </div>
</nav>
