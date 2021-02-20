<?php
require_once(ROOT_PATH.'/Models/Favorites.php');

class FavoritesController {
  private $request; //リクエストパラメータ(GET,POST)


  public function __construct() {
    //  リクエストパラメータの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    //モデルオブジェクトの生成
    $this->Favorites = new Favorites();
  }

  //ユーザIDに一致したすべてのお気に入りを参照
  public function user_favorites($arr) {
    $result = $this->Favorites->findUserId($arr);
    return $result;
  }

  //ユーザIDに一致したすべてのお気に入りの数を数える
  public function count_user_favorites($arr) {
    $result = $this->Favorites->findUserId($arr);
    return count($result);
  }

  //お気に入りID(GET送信された)に一致した予約を参照全参照
  public function find_favorites() {
    $result = $this->Favorites->findFavoritesId($this->request['get']['favorites_id']);
    return $result;
  }

  //お気に入り登録解除
  public function unregister() {
    $this->Favorites->delete($this->request['get']['favorites_id']);
  }

  //お気に入り登録
  public function add_favorite() {
    if($this->request['post']) {
      $this->Favorites->add($this->request['post']);
    }
  }

  //お気に入り解除
  public function delete_favorite() {
    if($this->request['post']) {
      $this->Favorites->deleteIdOther($this->request['post']);
    }
  }

  //お気に入りしているかどうかのチェック
  public function check_favorite($plans_id, $users_id, $start_date) {
      $result = $this->Favorites->findFavoritesIdOther($plans_id, $users_id, $start_date);
      return count($result);
  }

}
