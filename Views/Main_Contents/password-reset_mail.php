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
    var result = ref.match(/[login.php]/);
    if(!result){
      location.href = "login.php";
    }
  }
</script>
<?php
require_once(ROOT_PATH.'/Controllers/UsersController.php');
$users = new UsersController();
//入力バリデート
$message = $users->email_check();
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
    <link rel="stylesheet" href="css/style/logoff_bg.css">

    <title>メール送信ページ</title>
  </head>
  <body>


    <div class="shadow-lg p-5 m-5 bg-white rounded">
      <h1>ログインパスワードの再設定</h1>

      <div class="p-5 text-center" style="font-size: 18px;">
        メールアドレスを入力して「送信」ボタンを押してください。<br>
        パスワードは送信されたメールにURLが記載されていますので、<br>
        URLからアクセスしパスワード変更画面から変更ください。
      </div>

      <form class="m-5" action="" method="post">
        <table id="user-input_table" class="table table-bordered table-hover">

          <!-- メール -->
          <tr>
            <th>メールアドレス</th>
            <td>
              <input type="text" name="email" value="" placeholder="メールアドレス" autofocus>
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message)) {echo "<div class='text-danger pt-1'>".$message."</div>";} ?></span>
            </td>
          </tr>

        </table>
        <button class="btn btn-primary btn-block" type="submit">送信</button>
      </form>
    </div>

  </body>
</html>
