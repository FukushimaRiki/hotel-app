<?php
require_once(ROOT_PATH.'/Models/Plans.php');

class PlansController {
  private $request; //リクエストパラメータ(GET,POST)


  public function __construct() {
    //  リクエストパラメータの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    //モデルオブジェクトの生成
    $this->Users = new Users();
  }

  //人数が一致したプランを参照
  public function add() {
    $this->Users->add();
  }

  //人数が一致したプランを参照
  public function number_search() {
    $result = $this->Users->numberFind($this->request['post']);
    return $result;
  }

  //IDが一致したプランを参照
  public function id_search() {
    $result = $this->Users->idFind($this->request['get']);
    return $result;
  }

}
