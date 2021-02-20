<?php
require_once(ROOT_PATH.'/Models/Db.php');

class Favorites extends Db {
  private $table = 'favorites';

  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }


  //参照(ユーザIDで検索)(plansテーブルとJOIN)
  public function findUserId($arr) {
    $sql = 'SELECT ';
    $sql .= $this->table.'.id, plans_id, users_id, start_date, last_date, name, image, number_people, breakfast, dinner, price,'.$this->table.'.created_at';
    $sql .= ' FROM '.$this->table;
    $sql .= ' JOIN plans ON plans.id =';
    $sql .=  $this->table.'.plans_id';
    $sql .= ' WHERE users_id = :users_id';
    $sth = $this->dbh->prepare($sql);
    $params = array(':users_id'=>$arr['id']);
    $sth->execute($params);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }


  //参照(favoriteテーブルID検索)(plansテーブルとJOIN)
  public function findFavoritesId($arr) {
    $sql = 'SELECT ';
    $sql .= $this->table.'.id, plans_id, users_id, start_date, last_date, name, image, number_people, breakfast, dinner, price,'.$this->table.'.created_at';
    $sql .= ' FROM '.$this->table;
    $sql .= ' JOIN plans ON plans.id =';
    $sql .=  $this->table.'.plans_id';
    $sql .= ' WHERE '.$this->table.'.id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(':id'=>$arr);
    $sth->execute($params);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }


  //参照(id以外検索)
  public function findFavoritesIdOther($plans_id, $users_id, $start_date) {
    $sql = 'SELECT * FROM '.$this->table;
    $sql .= ' WHERE plans_id = :plans_id AND users_id = :users_id AND start_date = :start_date';
    $sth = $this->dbh->prepare($sql);
    $params = array(
      ':plans_id'=>$plans_id,
      ':users_id'=>$users_id,
      ':start_date'=>$start_date
    );
    $sth->execute($params);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }


  //挿入
  public function add($arr) {
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

  //削除(id検索)
  public function delete($arr) {
    $sql = 'DELETE FROM '.$this->table;
    $sql .= ' WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(':id'=>$arr);
    $sth->execute($params);
  }

  //削除(id以外検索)
  public function deleteIdOther($arr) {
    $sql = 'DELETE FROM '.$this->table;
    $sql .= ' WHERE plans_id = :plans_id AND users_id = :users_id AND start_date = :start_date AND last_date = :last_date';
    $sth = $this->dbh->prepare($sql);
    $params = array(
      ':plans_id'=>$arr['plans_id'],
      ':users_id'=>$arr['users_id'],
      ':start_date'=>$arr['start_date'],
      ':last_date'=>$arr['last_date'],
    );
    $sth->execute($params);
  }

}
