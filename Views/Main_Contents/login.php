<?php
session_start();
$_SESSION['User'] = 0;
require_once(ROOT_PATH.'/Controllers/UsersController.php');
$users = new UsersController();

// ログイン時のユーザチェック
$result = $users->login_check();
if($result) {
  $_SESSION['User'] = $result;
  header('Location: top.php');
  exit();
}else{
  $message = "入力した内容が正しくありません。";
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
    <link rel="stylesheet" href="css/style/logoff_bg.css">
    <link rel="stylesheet" href="css/style/login.css">

    <title>ログインページ</title>
  </head>
  <body>

    <div class="container">
      <div class="card card-container bg-white">

        <img id="profile-img" class="profile-img-card" src="img/logo_white.jpeg" />

        <form class="form-signin" method="post">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="text" name="email" class="form-control" placeholder="ユーザ名(メールアドレス)" autofocus value="<?php if($_POST) {echo htmlspecialchars($_POST['email']);} ?>">
            <input type="password" name="password" class="form-control" placeholder="パスワード">
            <?php if($_POST && empty($result)) {echo "<div class='text-danger text-left'>".$message."</div>";} ?>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">ログイン</button>
        </form>

        <a href="registration.php" class="forgot-password text-center mt-3">
            新規作成
        </a>

        <a href="password-reset_mail.php" class="forgot-password text-center">
            パスワードを忘れた方
        </a>

      </div>
    </div>

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
    <!-- <?php require("../Views/validate.php") ?> -->
    <!-- <script>
      $(function(){
        login_val();
      })
    </script> -->

  </body>
</html>
