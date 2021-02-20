<!-- 旅行者用ロセッション（ログイン・ログアウト） -->
<?php
session_start();

//ログアウト処理
if(isset($_GET['logout'])) {
  //セッションの値を空にする
  $_SESSION['User'] = array();
  session_destroy();
}

//ログイン処理
if($_SESSION['User']['user_categories'] == 1) { //ユーザ区分が管理者であれば管理者画面に遷移
  header('Location: top_administrator.php');
  exit();
}elseif(!isset($_SESSION['User']['user_categories'])) { //セッションに値がなければログイン画面に遷移
  header('Location: login.php');
  exit();
}
