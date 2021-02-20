<?php
require(ROOT_PATH.'/Views/session_administrator.php');
require_once(ROOT_PATH.'/Controllers/ReservationsController.php');
$reservations = new ReservationsController();
$reservation = $reservations->all_reservations();
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

    <title>全予約情報一覧ページ</title>
  </head>
  <body>

    <!-- requireでheaderを表示 -->
    <?php require("../Views/header_administrator.php") ?>

    <div class="wrapper bg-light">
      <div class="content">
        <h1>全予約情報一覧</h1>

        <table id="all_table" class="table table-bordered mt-5">
          <thead class="thead text-center">
            <tr>
              <th class="bg-dark text-white" colspan="4">全予約情報一覧</th>
            </tr>
            <tr>
              <th>予約者名</th>
              <th>プラン名</th>
              <th>宿泊期間</th>
              <th>詳細情報</th>
            </tr>
          </thead>
          <tbody class="tbody">

            <?php foreach($reservation as $row): ?>
            <tr class="text-center">
              <td><?=$row['last_name'].$row['first_name'] ?></td>
              <td><?=$row['name'] ?></td>
              <td><?=date('Y月m年d日', strtotime($row['start_date'])).'～'.date('Y月m年d日', strtotime('+1 day', strtotime($row['start_date']))) ?></td>
              <td>
                <a href="plan_detail.php?reservations_id=<?=$row['id'] ?>">詳細</a>
              </td>
            </tr>
          <?php endforeach; ?>

          </tbody>
        </table>


      </div>
    </div>

    <!-- requireでfooterを表示 -->
    <?php require("../Views/footer.php") ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, Popper.js, Bootstrap JSの順番に読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
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
