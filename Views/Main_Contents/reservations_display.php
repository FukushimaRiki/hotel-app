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
<script>
  $(function(){
    referrer();
  })

  //リファラー
  function referrer(){
    var ref = document.referrer;
    var result = ref.match(/[mypage.php]/);
    if(!result){
      location.href = "mypage.php";
    }
  }
</script>

<?php
require(ROOT_PATH.'/Views/session_user.php');
require_once(ROOT_PATH.'/Controllers/ReservationsController.php');
$reservations = new ReservationsController();
$user_reservations = $reservations->user_reservations($_SESSION['User']);
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

    <title>予約情報ページ</title>
  </head>
  <body>

    <!-- requireでheaderを表示 -->
    <?php require("../Views/header_user.php") ?>

    <div class="wrapper bg-light" style="min-height: 80vh;">
      <div class="content">
        <h1>予約情報</h1>

        <div class="mt-5">

          <?php foreach($user_reservations as $row): ?>
            <table id="plan_table" class="table table-bordered mb-3">
              <tr>
                <th><?=$row['name'] ?>（日付：<?=date('Y年m月d日',strtotime($row['start_date'])) ?>）（人数：<?=$row['number_people'] ?>人）</th>
                <td>
                  <a href="reservation_detail.php?reservations_id=<?=$row['id'] ?>">詳細</a>
                </td>
              </tr>
            </table>
          <?php endforeach; ?>

        </div>

      </div>
    </div>

    <!-- requireでfooterを表示 -->
    <?php require("../Views/footer.php") ?>

  </body>
</html>
