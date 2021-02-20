<?php
require_once(ROOT_PATH.'/Models/Reservations.php');

class ReservationsController {
  private $request; //リクエストパラメータ(GET,POST)


  public function __construct() {
    //  リクエストパラメータの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    //モデルオブジェクトの生成
    $this->Reservations = new Reservations();
  }

  //すべての予約参照
  public function all_reservations() {
    $result = $this->Reservations->findAll();
    return $result;
  }

  //ユーザIDに一致したすべての予約を参照
  public function user_reservations($arr) {
    $result = $this->Reservations->findUserId($arr);
    return $result;
  }

  //ユーザIDに一致したすべての予約の数を数える
  public function count_user_reservations($arr) {
    $result = $this->Reservations->findUserId($arr);
    return count($result);
  }

  //予約IDに一致した予約を参照（GET送信）
  public function find_reservations() {
    $result = $this->Reservations->findReservationsId($this->request['get']);
    return $result;
  }

  //空室検索の条件に一致した予約数を数える
  public function count_search_reservations() {
    $result = $this->Reservations->findSearchResult($this->request['post']);
    return count($result);
  }



  // //空室検索の条件に一致した予約数が５以上の場合
  // public function search_no_result() {
  //   if($this->request['post']) {
  //     $result = $this->Reservations->findSearchResult($this->request['post']);
  //     if(count($result) >= 1 ) {
  //       header('Location: top.php');
  //       exit();
  //     }
  //   }
  // }

  //予約IDが一致した予約をキャンセルする
  public function cancel() {
    $this->Reservations->delete($this->request['get']);
  }


  //空室検索した旅行を予約する
  public function reservation($get, $session, $start_date, $last_date) {
    $this->Reservations->add($get, $session, $start_date, $last_date);
  }

  //お気に入りにした旅行を予約する
  public function reservation_favorite($arr) {
    $this->Reservations->addFavorite($arr);
  }

}
