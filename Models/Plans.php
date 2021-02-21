<?php
require_once(ROOT_PATH.'/Models/Db.php');

class Users extends Db {
  private $table = 'plans';

  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }

  //挿入
  public function add() {
    $sql = 'INSERT INTO '.$this->table;
    $sql .= ' (name, image, number_people, breakfast, dinner, price)';
    $sql .= ' VALUE ("ダブル素泊まりプラン", "double-room.jpg", 2, "なし", "なし", 10000)';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
  }

  //人数からプラン参照
  public function numberFind($arr) {
    $sql = 'SELECT * FROM '.$this->table;
    $sql .= ' WHERE number_people = :number_people';
    $sth = $this->dbh->prepare($sql);
    $params = array(':number_people'=>$arr['number_people']);
    $sth->execute($params);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  //IDからプラン参照
  public function idFind($arr) {
    $sql = 'SELECT * FROM '.$this->table;
    $sql .= ' WHERE id = :id';
    $sth = $this->dbh->prepare($sql);
    $params = array(':id'=>$arr['id']);
    $sth->execute($params);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
}
