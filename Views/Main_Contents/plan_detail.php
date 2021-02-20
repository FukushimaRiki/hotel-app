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
    plan_delete();
  })

  //リファラー
  function referrer(){
    var ref = document.referrer;
    var result = ref.match(/[all-plan_display.php]/);
    if(!result){
      location.href = "all-plan_display.php";
    }
  }
</script>

<?php
require(ROOT_PATH.'/Views/session_administrator.php');
$_SESSION['User']['referrer'] = 1;
require_once(ROOT_PATH.'/Controllers/ReservationsController.php');
$reservations = new ReservationsController();
$reservation = $reservations->find_reservations();
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

    <title>選択予約詳細ページ</title>
  </head>
  <body>

    <!-- requireでheaderを表示 -->
    <?php require("../Views/header_administrator.php") ?>

    <div class="wrapper bg-light">
      <div class="content">
        <h1>予約詳細情報</h1>

        <table id="user_table" class="table table-bordered mt-5">
          <tr>
            <th class="thead" colspan="2">予約情報</th>
          </tr>
          <!-- 予約者名 -->
          <tr>
            <th>予約者名</th>
            <td><?=$reservation['last_name'].$reservation['first_name'] ?></td>
          </tr>
          <!-- 予約者電話番号 -->
          <tr>
            <th>予約者電話番号</th>
            <td><?=$reservation['tel'] ?></td>
          </tr>
          <!-- プラン名 -->
          <tr>
            <th>プラン名</th>
            <td><?=$reservation['name'] ?></td>
          </tr>
          <!-- 宿泊期間 -->
          <tr>
            <th>宿泊期間</th>
            <td><?=date('Y月m年d日', strtotime($reservation['start_date'])).'～'.date('Y月m年d日', strtotime('+1 day', strtotime($reservation['start_date']))) ?></td>
          </tr>
          <!-- 予約日 -->
          <tr>
            <th>予約日</th>
            <td><?=date('Y月m年d日', strtotime($reservation['created_at'])) ?></td>
          </tr>
        </table>

        <!-- キャンセルボタン -->
        <a id="plan_delete" class="complete-btn bg-danger text-white mb-3 p-2" href="">削除</a>

        </div>

      </div>
    </div>

    <!-- requireでfooterを表示 -->
    <?php require("../Views/footer.php") ?>

    <script>
      //予約を削除するかの確認用ポップアップ
      function plan_delete() {
        $('#plan_delete').on('click',function() {
          if (confirm('削除してもよろしいでしょうか？')) {
            $('#plan_delete').attr('href','plan_delete.php?reservations_id=<?=$reservation['id'] ?>');
          }
        })
    }
    </script>

  </body>
</html>
