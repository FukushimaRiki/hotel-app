<?php
  //  お気に入り登録
  require_once(ROOT_PATH.'/Controllers/FavoritesController.php');
  $favorites = new FavoritesController();
  $favorites->add_favorite();
 ?>
