<?php
require_once(ROOT_PATH.'/Models/Users.php');

class UsersController {
  private $request; //リクエストパラメータ(GET,POST)


  public function __construct() {
    //  リクエストパラメータの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    //モデルオブジェクトの生成
    $this->Users = new Users();
  }

  //ログインチェック
  public function login_check() {
    if($this->request['post']) {
      $user = $this->Users->emailFind($this->request['post']);
      if($user) {
        $password = $this->request['post']['password'];
        $hash = $user['password'];
        if (password_verify($password,$hash)) {
            return $user;
        }
      }
    }
  }

  //メールのバリデーションとユーザチェック
  public function email_check() {
    if($this->request['post']) {
      $message = $this->Users->emailCheck($this->request['post']['email']);
      return $message;
    }
  }

  //パスワードのバリデーション
  public function password_val() {
    if($this->request['post']) {
      $user = $this->Users->specialChara($this->request['post']);
      $message = $this->Users->passwordValidate($user);
      return $message;
    }
  }

  // ユーザ情報入力時の内容の特殊文字を削除・変換
  public function view() {
    //post送信があった場合、特殊文字を削除・変更
    if($this->request['post']) {
      $user = $this->Users->specialChara($this->request['post']);
      return $user;
    }
  }

  //ユーザ情報入力バリデーション
  public function val($arr) {
    if($arr) {
      $message = $this->Users->validate($arr);
      return $message;
    }
  }

  //送られてきた内容をユーザテーブルに挿入
  public function add() {
    $this->Users->add($this->request['post']);
  }

  //送られてきた内容をユーザテーブルで更新
  public function user_edit($id) {
    $this->Users->edit($this->request['post'],$id);
  }

  //ユーザ情報更新時にセッションの更新
  public function session_update($id) {
    $result = $this->Users->idFind($id);
    return $result;
  }

  //get送信された['users_id']からユーザ挿入
  public function password_update() {
    $this->Users->passwordEdit($this->request['post'],$this->request['get']['users_id']);
  }

  //管理者以外のユーザを参照する
  public function users_all() {
    $result = $this->Users->findUsers();
    return $result;
  }

  //get送信されたIDからユーザ参照
  public function id_search() {
    $result = $this->Users->idFind($this->request['get']['id']);
    return $result;
  }

  //get送信されたIDからユーザ削除
  public function id_delete() {
    $this->Users->delete($this->request['get']['id']);
  }


}
