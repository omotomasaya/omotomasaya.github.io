<?php
session_start();
  include 'database/connection.php';
  include 'classes/user.php';
  include 'classes/tweet.php';

  global $pdo;

  $getFromU = new User($pdo);
  $getFromT = new Tweet($pdo);

?>