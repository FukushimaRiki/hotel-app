
<?php
require_once(ROOT_PATH.'/Models/Db.php');

class Users extends Db {
  private $table = 'users';

  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }


  //管理者以外のユーザ参照
  public function findUsers() {
    $sql = 'SELECT * FROM '.$this->table;
    $sql .= ' WHERE user_categories = 2';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  // メールからユーザ参照
  public function emailFind($arr) {
    $sql = 'SELECT * FROM '.$this->table;
    $sql .= ' WHERE email = :email';
    $sth = $this->dbh->prepare($sql);
    $params = array(':email'=>$arr['email']);
    $sth->execute($params);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  // IDからユーザ参照
  public function idFind($id) {
    $sql = 'SELECT * FROM '.$this->table;
    $sql .= ' WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(':id'=>$id);
    $sth->execute($params);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  //挿入
  public function add($arr) {
    $sql = 'INSERT INTO '.$this->table;
    $sql .= ' (user_categories, last_name, first_name, last_name_kana, first_name_kana, email, password, tel, postcode, prefecture_id, city, block, building, created_at)';
    $sql .= ' VALUE (2, :last_name, :first_name, :last_name_kana, :first_name_kana, :email, :password, :tel, :postcode, :prefecture_id, :city, :block, :building, :created_at)';
    $sth = $this->dbh->prepare($sql);
    $params = array(
      ':last_name'=>$arr['last_name'],
      ':first_name'=>$arr['first_name'],
      ':last_name_kana'=>$arr['last_name_kana'],
      ':first_name_kana'=>$arr['first_name_kana'],
      ':email'=>$arr['email'],
      ':password'=>password_hash($arr['password'], PASSWORD_DEFAULT),
      ':tel'=>$arr['tel'],
      ':postcode'=>$arr['postcode'],
      ':prefecture_id'=>$arr['prefecture_id'],
      ':city'=>$arr['city'],
      ':block'=>$arr['block'],
      ':building'=>$arr['building'],
      ':created_at'=>date('Y-m-d H:i:s')
    );
    $sth->execute($params);
  }

  //更新
  public function edit($arr,$id) {
    $sql = 'UPDATE '.$this->table;
    $sql .= ' SET last_name = :last_name, first_name = :first_name, last_name_kana = :last_name_kana, first_name_kana = :first_name_kana, email = :email, password = :password, tel = :tel, postcode =:postcode, prefecture_id =:prefecture_id, city = :city, block = :block, building = :building, updated_at = :updated_at';
    $sql .= ' WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(
      ':last_name'=>$arr['last_name'],
      ':first_name'=>$arr['first_name'],
      ':last_name_kana'=>$arr['last_name_kana'],
      ':first_name_kana'=>$arr['first_name_kana'],
      ':email'=>$arr['email'],
      ':password'=>password_hash($arr['password'], PASSWORD_DEFAULT),
      ':tel'=>$arr['tel'],
      ':postcode'=>$arr['postcode'],
      ':prefecture_id'=>$arr['prefecture_id'],
      ':city'=>$arr['city'],
      ':block'=>$arr['block'],
      ':building'=>$arr['building'],
      ':updated_at'=>date('Y-m-d H:i:s'),
      ':id'=>$id
    );
    $sth->execute($params);
  }

  //更新（パスワードのみ）
  public function passwordEdit($arr,$id) {
    $sql = 'UPDATE '.$this->table;
    $sql .= ' SET password = :password, updated_at = :updated_at';
    $sql .= ' WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(
      ':password'=>password_hash($arr['password'], PASSWORD_DEFAULT),
      ':updated_at'=>date('Y-m-d H:i:s'),
      ':id'=>$id
    );
    $sth->execute($params);
  }

  //削除
  public function delete($id) {
    $sql = 'DELETE FROM '.$this->table;
    $sql .= ' WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(':id'=>$id);
    $sth->execute($params);
  }


  //特殊文字削除・変換
  public function specialChara($arr) {
    $user = array();
    foreach ($arr as $key => $value) {
      $user[$key] = preg_replace("/(\"|\'|<|>)/", "", $value);
      $user[$key] = htmlspecialchars($user[$key],ENT_QUOTES);
    }
    return $user;
  }

  //バリデーション
  public function validate($arr) {
    $message = array();

    //苗字,名前
    if(empty($arr['last_name'])||empty($arr['first_name'])) { //未入力チェック
      $message['name'] = '名前が未入力です。';
    }elseif(mb_strlen($arr['last_name']) > 10||mb_strlen($arr['first_name']) > 10) { //10文字制限
      $message['name'] = '10文字以内で入力して下さい。';
    }

    //苗字(フリガナ),名前(フリガナ)
    if(empty($arr['last_name_kana'])||empty($arr['first_name_kana'])) { //未入力チェック
      $message['kana'] = 'フリガナが未入力です。';
    }elseif(mb_strlen($arr['last_name_kana']) > 20||mb_strlen($arr['first_name_kana']) > 20) { //10文字制限
      $message['kana'] = '20文字以内で入力して下さい。';
    }

    //メールアドレス
    if(empty($arr['email'])) { //未入力チェック
      $message['email'] = 'メールアドレスが未入力です。';
    }elseif(!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) { //メール型チェック
      $message['email'] = 'メールアドレスが正しくありません。';
    }

    //パスワード
    if(empty($arr['password'])||empty($arr['password_re'])) { //未入力チェック
      $message['password'] = 'パスワードが未入力です。';
    }elseif(mb_strlen($arr['password']) < 4||mb_strlen($arr['password']) > 10||mb_strlen($arr['password_re']) < 4||mb_strlen($arr['password_re']) > 10) { //文字数制限
      $message['password'] = '4文字以上10文字以下で入力ください。';
    }elseif(!preg_match("/^[0-9a-zA-Z]+$/",$arr['password'])||!preg_match("/^[0-9a-zA-Z]+$/",$arr['password_re'])) { //パスワード文字チェック
      $message['password'] = 'パスワードは半角英数字で入力ください。';
    }elseif($arr['password'] != $arr['password_re']) {
      $message['password'] = '再入力も同じ文字を入力ください。';
    }

    //電話番号
    if(empty($arr['tel'])) { //未入力チェック
      $message['tel'] = '電話番号が未入力です。';
    }elseif(!preg_match("/^[0-9]+$/",$arr['tel'])) { //数字文字チェック
      $message['tel'] = '電話番号は数字(ハイフンなし)で入力ください。';
    }

    //郵便番号
    if(empty($arr['postcode'])) { //未入力チェック
      $message['postcode'] = '郵便番号が未入力です。';
    }elseif(!preg_match("/^[0-9]+$/",$arr['postcode'])) { //数字文字チェック
      $message['postcode'] = '郵便番号は数字(ハイフンなし)で入力ください。';
    }elseif(mb_strlen($arr['postcode']) != 7) { //数字文字チェック
      $message['postcode'] = '郵便番号は7文字で入力ください。';
    }

    //都道府県名
    if(empty($arr['prefecture_id'])) { //未入力チェック
      $message['prefecture_id'] = '都道府県が未選択です。';
    }

    //住所1(市区町村)
    if(empty($arr['city'])) { //未入力チェック
      $message['city'] = '市区町村が未入力です。';
    }elseif(mb_strlen($arr['city']) > 50) { //文字数チェック
      $message['city'] = '市区町村は50文字以下で入力ください。';
    }

    //住所2(番地)
    if(empty($arr['block'])) { //未入力チェック
      $message['block'] = '番地が未入力です。';
    }elseif(mb_strlen($arr['city']) > 50) { //文字数チェック
      $message['block'] = '番地は50文字以下で入力ください。';
    }

    //住所3(建物名)
    if(mb_strlen($arr['building']) > 50) { //文字数チェック
      $message['building'] = '建物名は50文字以下で入力ください。';
    }

    return $message;
  }

  //メールの特殊文字削除・変換->バリデーション->メールからユーザチェック
  public function emailCheck($arr) {
      //特殊文字の削除・変換
      $email = preg_replace("/(\"|\'|<|>)/", "", $arr);
      $email = htmlspecialchars($email,ENT_QUOTES);

      if(empty($email)) { //未入力チェック
        $message = 'メールアドレスが未入力です。';
      }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { //メール型チェック
        $message = 'メールアドレスが正しくありません。';
      }else{
        $sql = 'SELECT * FROM '.$this->table;
        $sql .= ' WHERE email = :email';
        $sth = $this->dbh->prepare($sql);
        $params = array(':email'=>$email);
        $sth->execute($params);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(!$result) { //アカウントチェック
          $message = 'アカウントが存在しません.';
        }else{
          header('Location: password-reset_input.php?users_id='.$result['id']);
          exit();
        }
      }
    return $message;
  }

  //パスワードのバリデーション
  public function passwordValidate($arr) {
    $message = array();
    //パスワード
    if(empty($arr['password'])) { //未入力チェック
      $message['password'] = 'パスワードが未入力です。';
    }elseif(mb_strlen($arr['password']) < 4||mb_strlen($arr['password']) > 10) { //文字数制限
      $message['password'] = '4文字以上10文字以下で入力ください。';
    }elseif(!preg_match("/^[0-9a-zA-Z]+$/",$arr['password'])) { //パスワード文字チェック
      $message['password'] = 'パスワードは半角英数字で入力ください。';
    }elseif($arr['password'] != $arr['password_re']) {
      $message['password'] = '同じ文字を入力ください。';
    }

    //パスワード(再入力)
    if(empty($arr['password_re'])) { //未入力チェック
      $message['password_re'] = 'パスワード(再入力)が未入力です。';
    }elseif(mb_strlen($arr['password_re']) < 4||mb_strlen($arr['password_re']) > 10) { //文字数制限
      $message['password_re'] = '4文字以上10文字以下で入力ください。';
    }elseif(!preg_match("/^[0-9a-zA-Z]+$/",$arr['password_re'])) { //パスワード文字チェック
      $message['password_re'] = 'パスワード(再入力)は半角英数字で入力ください。';
    }elseif($arr['password'] != $arr['password_re']) {
      $message['password_re'] = '同じ文字を入力ください。';
    }
    return $message;
  }

}
