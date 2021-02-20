<?php
  //  お気に入り解除
  require_once(ROOT_PATH.'/Controllers/FavoritesController.php');
  $favorites = new FavoritesController();
  $favorites->delete_favorite();
 ?>
