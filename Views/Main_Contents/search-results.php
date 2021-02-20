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
    no_result();
  })

  //リファラー
  function referrer(){
    var ref = document.referrer;
    var result1 = ref.match(/[top.php]/);
    var result2 = ref.match(/[search-result_detail.php]/);
    if(!result1 || !result2){
      location.href = "top.php";
    }
  }
</script>

<?php
require(ROOT_PATH.'/Views/session_user.php');
//プランテーブル
require_once(ROOT_PATH.'/Controllers/PlansController.php');
$plans = new PlansController();
//人数に一致したプラン
$plan = $plans->number_search();

//予約テーブル
require_once(ROOT_PATH.'/Controllers/ReservationsController.php');
$reservations = new ReservationsController();
//日付と人数に一致した予約の数
$number_result = $reservations->count_search_reservations();


$start_date = date('Y月m年d日', strtotime($_POST['start_date']));
$last_date = date('Y月m年d日', strtotime('+1 day', strtotime($_POST['start_date'])));
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

    <title>空室検索結果ページ</title>
  </head>
  <body>

    <!-- requireでheaderを表示 -->
    <?php require("../Views/header_user.php") ?>

    <div class="wrapper bg-light">
      <div class="content">
        <h1>空室検索</h1>

        <div class="mt-5">

          <div id="conditions" class="p-3 bg-white border border-dark text-center" style="width: 80%; margin: 20px auto;">
            <span style="font-weight: bold;">条件</span>
            [宿泊期間：<?=$start_date ?>～<?=$last_date ?>][宿泊人数：<?=$_POST['number_people']?>人]
          </div>

          <?php foreach($plan as $row): ?>
            <table id="plan_table" class="table table-bordered mb-3">
              <tr>
                <th>
                  <?=$row['name'] ?>（日付：<?=$start_date ?>）（人数：<?=$row['number_people']?>人）
                  <span id="vacant_rooms" class="text-danger">残り<?php echo 5-$number_result ?>部屋</span>
                </th>
                <td>
                  <a href="search-result_detail.php?id=<?=$row['id'] ?>&start_date=<?=$_POST['start_date'] ?>">詳細</a>
                </td>
              </tr>
            </table>
          <?php endforeach; ?>

        </div>

      </div>
    </div>

    <!-- requireでfooterを表示 -->
    <?php require("../Views/footer.php") ?>

    <script>
      //空室がない時にエラー表示
      function no_result(){
        if(<?=$number_result ?> >= 5) {
          alert('検索内容に一致する空室が見つかりませんでした。');
          window.location.href = "top.php";
        }
      }
    </script>

  </body>
</html>
