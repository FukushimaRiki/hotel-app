<?php
require(ROOT_PATH.'/Views/session_user.php');
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

    <title>サンビーチホテル【公式】| TOPページ</title>
  </head>
  <body>

    <!-- requireでheaderを表示 -->
    <?php require("../Views/header_user.php") ?>

    <!-- メニューバー -->
    <div id="top-menu" class="container-fluid" style="background: #938983;">
      <div class="row">
        <a class="col border-right border-light nav-link" href="#top">トップ</a>
        <a class="col border-right border-light nav-link" href="#dish">料理</a>
        <a class="col border-right border-light nav-link" href="#room">部屋</a>
        <a class="col border-right border-light nav-link" href="#spa">温泉</a>
        <a class="col nav-link" href="#access">アクセス</a>
      </div>
    </div>

    <!-- スライダー -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
           <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
           <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
           <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
           <div class="carousel-item active">
             <img src="img/main-image2.jpg" class="d-block w-100" alt="メイン画像">
           </div>
           <div class="carousel-item">
             <img src="img/main-image5.jpg" class="d-block w-100" alt="メイン画像">
           </div>
           <div class="carousel-item">
             <img src="img/main-image3.jpg" class="d-block w-100" alt="メイン画像">
           </div>
         </div>
         <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
           <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
           <span class="carousel-control-next-icon" aria-hidden="true"></span>
           <span class="sr-only">Next</span>
         </a>
     </div>

    <div class="wrapper bg-light">
      <div class="content">

        <!-- 空室検索 -->
        <div class="shadow-lg bg-white mb-5 p-3">

          <form action="search-results.php" method="post">

            <div id="room_search" class="row">
              <!-- 宿泊日選択 -->
              <div class="col">
                <div class="d-inline pl-4 pr-4" style="font-size: 20px;">ご宿泊日</div>
                <input type="date" name="start_date" min="<?=date("Y-m-d"); ?>" value="<?php if($_POST) {echo $_POST['start_date'];} ?>" style="width: 250px; height: 50px;">
              </div>
              <!-- 人数選択 -->
              <div class="col">
                <div class="d-inline pl-4 pr-4" style="font-size: 20px;">人数</div>
                <select id="number_people" class="" name="number_people" value="<?php if($_POST) {echo $_POST['number_of_people'];} ?>" style="width: 250px; height: 50px;">
                  <option value="" selected>人数</option>
                  <option value="1">1人</option>
                  <option value="2">2人</option>
                </select>
              </div>
            </div>

            <button class="btn btn-primary btn-block mt-2" type="submit">空室検索</button>
          </form>

        </div>

        <!-- 料理  -->
        <div id="dish" class="card text-dark text-center mb-5" style="width: 90%; margin: 0 auto;">
          <img src="img/cards-dish.jpg" class="card-img" alt="..." style="opacity: 0.3;">
          <div class="card-img-overlay">
            <h2 class="card-title m-5">DISH</h2>
            <p class="card-text h5 m-5">生産者が愛情を注いで育てたA5等級の和牛。<br> サーロインやヒレを鉄板焼きスタイルでどうぞ。<br>お客様からは「量・質ともに大変満足」「とにかくお肉が柔らかい」など、喜びの声が多数寄せられています。シェフが目の前で焼き上げるパフォーマンスも注目です。</p>
            <p class="card-text">[夕食:17時30分～21時]<br>[朝食:8時～10時]</p>
          </div>
        </div>

        <!-- 部屋 -->
        <div id="room" class="card text-dark text-center mb-5" style="width: 90%; margin: 0 auto;">
          <img src="img/cards-room.jpg" class="card-img" alt="..." style="opacity: 0.4;">
          <div class="card-img-overlay">
            <h2 class="card-title m-5">ROOM</h2>
            <p class="card-text h5 p-5">シックな空間に高級感漂うインテリアデザインを採用しています。<br>ご家族・ご友人同士でのご宿泊や、おひとり様でゆったりとくつろぎたい方に最適なお部屋です。</p>
            <p class="card-text"></p>
          </div>
        </div>

        <!-- 温泉 -->
        <div id="spa" class="card text-darkk text-center mb-5" style="width: 90%; margin: 0 auto;">
          <img src="img/cards-spa.jpg" class="card-img" alt="..." style="opacity: 0.4;">
          <div class="card-img-overlay">
            <h2 class="card-title m-5">SPA</h2>
            <p class="card-text h5 p-5">乳白色の湯がなみなみと注ぐ湯船に浸かれば、遮るものなく壮大な自然と一体となる。<br>冬の夕刻には真正面に陽が沈み、<br>暗闇とともに訪れる満天の星と過ごす湯浴みも最高だ。</p>
            <p class="card-text"></p>
          </div>
        </div>

        <!-- アクセス -->
        <div id="access" class="" style="width: 100%; margin: 0 auto;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1885.7380860024623!2d139.07526877483497!3d35.097949558205045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6019bf2da754df55%3A0x1e064360cec6807c!2z54ax5rW344K144Oz44OT44O844OB!5e0!3m2!1sja!2sjp!4v1612371945369!5m2!1sja!2sjp" width="100%" height="450px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          <div class="text-center">
            〒413-0012 静岡県熱海市東海岸町
          </div>
        </div>

        <!-- 問い合わせ -->
        <div id="contact" class="text-center">
          <div class="">お電話でのご予約・お問い合わせ</div>
          <div class="">0120-××××-〇〇〇〇（営業時間9:00～20:00）</div>
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

    <!-- バリデートの読み込み -->
    <?php require("../Views/validate.php") ?>
    <script>
      $(function(){
        room_search_val();
        number_of_people();
      })

      // 都道府県選択
      function number_of_people() {
        $('#number_of_people').val('<?php if($_POST){echo $_POST['number_of_people'];} ?>');
      }
    </script>

  </body>
</html>
