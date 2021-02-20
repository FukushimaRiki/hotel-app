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
    referrer();
    cancel();
  })

  //リファラー
  function referrer(){
    var ref = document.referrer;
    var result = ref.match(/[favorites_display.php]/);
    if(!result){
      location.href = "mypage.php";
    }
  }
</script>

<?php
require(ROOT_PATH.'/Views/session_user.php');
//完了画面の画面更新による複数回の更新を防ぐために['referrer']を1に変更
$_SESSION['User']['referrer'] = 1;

require_once(ROOT_PATH.'/Controllers/FavoritesController.php');
$favorites = new FavoritesController();
$favorite = $favorites->find_favorites();
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

    <title>お気に入りプラン詳細ページ</title>
  </head>
  <body>

    <!-- requireでheaderを表示 -->
    <?php require("../Views/header_user.php") ?>

    <div class="wrapper bg-light">
      <div class="content">
        <h1>お気に入り</h1>

        <table id="plan-detail_table" class="table table-bordered mt-5">
          <tr>
            <th class="thead" colspan="2">お気に入り詳細情報</th>
          </tr>
          <!-- プラン名 -->
          <tr>
            <th class="plan-name" colspan="2">
              <?=$favorite['name'] ?>
            </th>
          </tr>
          <!-- プラン画像 -->
          <tr>
            <th class="plan-image" colspan="2">
              <img src="img/<?=$favorite['image'] ?>" alt="プラン画像" style="width: 90%;">
            </th>
          </tr>
          <!-- 宿泊期間 -->
          <tr>
            <th>宿泊期間</th>
            <td><?=date('Y年m月d日', strtotime($favorite['start_date'])).'～'.date('Y年m月d日', strtotime($favorite['last_date'])) ?></td>
          </tr>
          <!-- 宿泊人数 -->
          <tr>
            <th>宿泊人数</th>
            <td><?=$favorite['number_people'] ?>人</td>
          </tr>
          <!-- 夕食 -->
          <tr>
            <th>夕食</th>
            <td><?=$favorite['dinner'] ?></td>
          </tr>
          <!-- 朝食 -->
          <tr>
            <th>朝食</th>
            <td><?=$favorite['breakfast'] ?></td>
          </tr>
          <!-- 部屋サイズ -->
          <tr>
            <th>部屋サイズ</th>
            <td><?php if($favorite['number_people'] == 1) {echo 'シングル';} else {echo 'ダブル';} ?></td>
          </tr>
          <!-- 料金 -->
          <tr>
            <th>料金</th>
            <td class="text-right"><span class="text-danger" style="font-size: 22px; font-weight: bold;"><?=$favorite['price'] ?>円</span>（1人あたり<?=$favorite['price']/$favorite['number_people'] ?>円・税込み）</td>
          </tr>

        </table>

        <!-- 予約ボタン -->
        <a id="favorite_reservation" class="complete-btn bg-danger text-white mb-3 p-2" href="">予約</a>


      </div>
    </div>

    <!-- requireでfooterを表示 -->
    <?php require("../Views/footer.php") ?>

    <script>
      //予約をキャンセルするかの確認用ポップアップ
      function cancel() {
        $('#favorite_reservation').on('click',function() {
          if (confirm('予約してもよろしいでしょうか？')) {
            $('#favorite_reservation').attr('href','favorite_reservation.php?favorites_id=<?=$favorite['id'] ?>');
          }
        })
    }
    </script>

  </body>
</html>
