<!-- 管理者用ロセッション（ログイン・ログアウト） -->
<?php
session_start();

//ログアウト処理
if(isset($_GET['logout'])) {
  //セッションの値を空にする
  $_SESSION['User'] = array();
  session_destroy();
}

//ログイン状態の遷移
if($_SESSION['User']['user_categories'] == 2) { //ユーザ区分が旅行者であれば旅行者画面に遷移
  header('Location: top_administrator.php');
  exit();
}elseif(!isset($_SESSION['User']['user_categories'])) { //セッションに値がなければログイン画面に遷移
  header('Location: login.php');
  exit();
}

 ?>
