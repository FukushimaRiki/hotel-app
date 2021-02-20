<?php
require(ROOT_PATH.'/Views/session_administrator.php');
//複数更新対策にSESSION['User']に['referrer']を追加
if(!isset($_SESSION['User']['referrer'])) {
  $_SESSION['User'] = $_SESSION['User']+array('referrer'=>0);
}
 ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSSの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- localhostの場合の接続 -->
    <!-- CSS読み込み -->
    <!-- <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"> -->

    <link rel="stylesheet" href="css/style/index.css">

    <title>管理者TOPページ</title>
  </head>
  <body>

    <!-- requireでheaderを表示 -->
    <?php require("../Views/header_administrator.php") ?>

    <div class="wrapper bg-light" style="min-height: 70vh;">
      <div class="content">

        <a class="complete-btn bg-primary text-white p-4" href="all-user_display.php" style="margin-top: 100px;font-size: 22px;">全ユーザ一覧</a>
        <a class="complete-btn bg-primary text-white p-4" href="all-plan_display.php" style="font-size: 22px;">全予約一覧</a>

      </div>
    </div>

    <!-- requireでfooterを表示 -->
    <?php require("../Views/footer.php") ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, Popper.js, Bootstrap JSの順番に読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- localhostの場合の接続 -->
    <!-- jQuery読み込み JSよりも先 -->
    <!-- <script src="js/jquery-3.5.1.min.js"></script> -->
    <!-- popper.js js読み込み -->
    <!-- <script src="js/proper.min.js"></script> -->
    <!-- popper.js js読み込み -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
  </body>
</html>
