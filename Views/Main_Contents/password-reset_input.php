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
    password_val();
  })

  //リファラー
  function referrer(){
    var ref = document.referrer;
    var result = ref.match(/[password-reset_mail.php]/);
    if(!result){
      location.href = "login.php";
    }
  }
</script>
<?php
//完了画面での複数回更新に毎回更新されるのを防ぐためセッション操作
session_start();
$_SESSION['referrer'] = 1;

require_once(ROOT_PATH.'/Controllers/UsersController.php');
$users = new UsersController();
$message = $users->password_val();

// バリデートの読み込み
require("../Views/validate.php");

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

    <title>パスワード再設定ページ</title>
  </head>

  <body>
    <div class="shadow-lg p-5 m-5 bg-white rounded" style="min-height: 85vh;">
      <h1>ログインパスワードの再設定</h1>

      <form class="p-5 mt-5" action="" method="post">
        <table id="user-input_table" class="table table-bordered table-hover">

          <!-- 新しいパスワード -->
          <tr>
            <th>新しいパスワード</th>
            <td>
              <input type="text" name="password" value="" placeholder="パスワード" autofocus>
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['password'])) {echo "<div class='text-danger pt-1'>".$message['password']."</div>";} ?></span>
            </td>
          </tr>
          <!-- 新しいパスワード(再入力) -->
          <tr>
            <th>新しいパスワード(再入力)</th>
            <td>
              <input type="text" name="password_re" value="" placeholder="パスワード">
              <!--入力に不備があった場合、不備内容を表示-->
              <br>
              <span><?php if(isset($message['password_re'])) {echo "<div class='text-danger pt-1'>".$message['password_re']."</div>";} ?></span>
            </td>
          </tr>

        </table>
        <button id="password-reset_complete" class="btn btn-primary btn-block mt-5" type="submit">確認</button>
      </form>
    </div>

    <script>
    // パスワード入力時のバリデーション
    function password_val() {
      $("button[type='submit']").on("click",function(){
        var result = 0;
        var password = $("input[name='password']").val().trim();
        var password_re = $("input[name='password_re']").val().trim();
        // 空欄チェック
        if(password == ""||password_re == "") {
          result++;
        }

        //パスワードの文字（英語・数字）チェック
        if((!(password.match(/^[0-9a-zA-Z]+$/)))||(!(password_re.match(/^[0-9a-zA-Z]+$/))))　{
          result++;
        }

        //パスワードの4文字以上10文字以下チェック
        if((password.length < 4)||(password.length > 10)||(password_re.length < 4)||(password_re.length > 10)){
          result++;
        }

        // パスワードと再入力パスワードが同一であるかのチャック
        if(!(password == password_re)) {
          result++;
        }

        //もしエラーが一つもなかったら送信される
        if(result >= 1) {
          $("form").attr("action","#");
        }else{
          if(confirm('このパスワードに変更してもよろしいでしょうか？')) { //予約をキャンセルするかの確認用ポップアップ
              $('form').attr('action','password-reset_complete.php?users_id=<?=$_GET['users_id'] ?>');
          }
        }

      })
    }

    </script>

  </body>
</html>
