<?php
require(ROOT_PATH.'/Views/session_user.php');
//予約テーブル
require_once(ROOT_PATH.'/Controllers/ReservationsController.php');
$reservations = new ReservationsController();
//ユーザの予約数を数える
$count_reservation = $reservations->count_user_reservations($_SESSION['User']);

//お気に入りテーブル
require_once(ROOT_PATH.'/Controllers/FavoritesController.php');
$favorites = new FavoritesController();
//お気に入りの数を数える
$count_favorite = $favorites->count_user_favorites($_SESSION['User']);

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
    <link rel="stylesheet" href="css/style/">

    <title>マイページ</title>
  </head>
  <body>

    <!-- requireでheaderを表示 -->
    <?php require("../Views/header_user.php") ?>

    <div class="wrapper bg-light">
      <div class="content">
        <h1>マイページ</h1>

        <table id="user_table" class="table table-bordered mt-5">
          <tr>
            <th class="thead" colspan="2">お客様情報</th>
          </tr>
          <!-- 氏名 -->
          <tr>
            <th>氏名</th>
            <td>
              <?php
              print_r($_SESSION['User']['last_name']);
              print_r($_SESSION['User']['first_name']);
               ?>
            </td>
          </tr>
          <!-- フリガナ -->
          <tr>
            <th>氏名(フリガナ)</th>
            <td>
              <?php
              print_r($_SESSION['User']['last_name_kana']);
              print_r($_SESSION['User']['first_name_kana']);
               ?>
            </td>
          </tr>
          <!-- メール -->
          <tr>
            <th>Eメールアドレス(ユーザ名)</th>
            <td><?php print_r($_SESSION['User']['email']) ?></td>
          </tr>
          <!-- 電話番号 -->
          <tr>
            <th>電話番号</th>
            <td><?php print_r($_SESSION['User']['tel']) ?></td>
          </tr>
          <!-- 郵便番号 -->
          <tr>
            <th>郵便番号</th>
            <td><?php print_r($_SESSION['User']['postcode']) ?></td>
          </tr>
          <!-- 都道府県 -->
          <tr>
            <th>都道府県名</th>
            <td><?php print_r($_SESSION['User']['prefecture_id']) ?></td>
            </td>
          </tr>
          <!-- 市区町村 -->
          <tr>
            <th>住所1(市区町村)</th>
            <td><?php print_r($_SESSION['User']['city']) ?></td>
          </tr>
          <!-- 番地 -->
          <tr>
            <th>住所2(番地)</th>
            <td><?php print_r($_SESSION['User']['block']) ?></td>
          </tr>
          <!-- 建物名 -->
          <tr>
            <th>住所3(建物名)</th>
            <td><?php if($_SESSION['User']['building']) {print_r($_SESSION['User']['building']);} ?></td>
          </tr>
        </table>

        <a  class="complete-btn text-white p-2" href="user-edit.php" style="background: #FF9966;">ユーザ情報編集</a>
        <div class="row">
          <div class="col">
            <a id="reservations_display" class="complete-btn bg-primary text-white p-2" href="reservations_display.php">予約情報</a>
          </div>
          <div class="col">
            <a id="favorites_display" class="complete-btn bg-primary text-white mb-3 p-2" href="favorites_display.php">お気に入りプラン</a>
          </div>

        </div>

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
    <script>
      $(function() {
        no_reservation();
        no_favorite();
      })

      //予約の数が０の場合、遷移しない。
      function no_reservation() {
        $('#reservations_display').on('click',function() {
          if(<?=$count_reservation ?> == 0) {
            alert('予約情報が見つかりませんでした。');
            $('#reservations_display').attr('href','mypage.php');
          }
        })
      }

      //お気に入りの数が０の場合、遷移しない。
      function no_favorite() {
        $('#favorites_display').on('click',function() {
          if(<?=$count_favorite ?> == 0) {
            alert('お気に入りプランが見つかりませんでした。');
            $('#favorites_display').attr('href','mypage.php');
          }
        })
      }


    </script>
  </body>
</html>
