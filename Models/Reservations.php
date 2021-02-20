<?php
require_once(ROOT_PATH.'/Models/Db.php');

class Reservations extends Db {
  private $table = 'reservations';

  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }


  //参照(すべて)(plansテーブルとJOIN)(usersテーブルとJOIN)(宿泊日早い順)
  public function findAll() {
    $sql = 'SELECT ';
    $sql .= $this->table.'.id, plans_id, users_id, start_date, last_date, name, image, number_people, breakfast, dinner, price, first_name, last_name, tel,'.$this->table.'.created_at';
    $sql .= ' FROM '.$this->table;
    $sql .= ' JOIN plans ON plans.id =';
    $sql .=  $this->table.'.plans_id';
    $sql .= ' JOIN users ON users.id =';
    $sql .=  $this->table.'.users_id';
    $sql .= ' ORDER BY start_date';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  //参照(reservationsテーブルID検索)(plansテーブルとJOIN)(usersテーブルとJOIN)
  public function findReservationsId($arr) {
    $sql = 'SELECT ';
    $sql .= $this->table.'.id, plans_id, users_id, start_date, last_date, name, image, number_people, breakfast, dinner, price, first_name, last_name, tel,'.$this->table.'.created_at';
    $sql .= ' FROM '.$this->table;
    $sql .= ' JOIN plans ON plans.id =';
    $sql .=  $this->table.'.plans_id';
    $sql .= ' JOIN users ON users.id =';
    $sql .=  $this->table.'.users_id';
    $sql .= ' WHERE '.$this->table.'.id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(':id'=>$arr['reservations_id']);
    $sth->execute($params);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  //参照(ユーザIDで検索)(plansテーブルとJOIN)(宿泊日早い順)
  public function findUserId($arr) {
    $sql = 'SELECT ';
    $sql .= $this->table.'.id, plans_id, users_id, start_date, last_date, name, image, number_people, breakfast, dinner, price,'.$this->table.'.created_at';
    $sql .= ' FROM '.$this->table;
    $sql .= ' JOIN plans ON plans.id =';
    $sql .=  $this->table.'.plans_id';
    $sql .= ' WHERE users_id = :id';
    $sql .= ' ORDER BY start_date';
    $sth = $this->dbh->prepare($sql);
    $params = array(':id'=>$arr['id']);
    $sth->execute($params);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  //参照(宿泊開始日と人数で検索)(plansテーブルとJOIN)
  public function findSearchResult($arr) {
    $sql = 'SELECT ';
    $sql .= $this->table.'.id, plans_id, users_id, start_date, last_date, name, image, number_people, breakfast, dinner, price,'.$this->table.'.created_at';
    $sql .= ' FROM '.$this->table;
    $sql .= ' JOIN plans ON plans.id =';
    $sql .=  $this->table.'.plans_id';
    $sql .= ' WHERE start_date = :start_date AND number_people = :number_people';
    $sth = $this->dbh->prepare($sql);
    $params = array(
      ':start_date'=>$arr['start_date'],
      ':number_people'=>$arr['number_people']
    );
    $sth->execute($params);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }


  //挿入(各要素に変数を挿入する場合)
  public function add($get, $session, $start_date, $last_date) {
    $sql = 'INSERT INTO '.$this->table;
    $sql .= ' (plans_id, users_id, start_date, last_date, created_at)';
    $sql .= ' VALUE (:plans_id, :users_id, :start_date, :last_date, :created_at)';
    $sth = $this->dbh->prepare($sql);
    $params = array(
      ':plans_id'=>$get,
      ':users_id'=>$session,
      ':start_date'=>$start_date,
      ':last_date'=>$last_date,
      ':created_at'=>date('Y-m-d H:i:s')
    );
    $sth->execute($params);
  }

  //挿入(配列から)
  public function addFavorite($arr) {
    $sql = 'INSERT INTO '.$this->table;
    $sql .= ' (plans_id, users_id, start_date, last_date, created_at)';
    $sql .= ' VALUE (:plans_id, :users_id, :start_date, :last_date, :created_at)';
    $sth = $this->dbh->prepare($sql);
    $params = array(
      ':plans_id'=>$arr['plans_id'],
      ':users_id'=>$arr['users_id'],
      ':start_date'=>$arr['start_date'],
      ':last_date'=>$arr['last_date'],
      ':created_at'=>date('Y-m-d H:i:s')
    );
    $sth->execute($params);
  }

  //削除
  public function delete($arr) {
    $sql = 'DELETE FROM '.$this->table;
    $sql .= ' WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(':id'=>$arr['reservations_id']);
    $sth->execute($params);
  }

}
