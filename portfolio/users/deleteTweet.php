<?php
require_once('../core/class.php');
  $user_id = $_SESSION['user_id'];
  $user = $getFromU->userData($user_id);
  $tweetBy = $user_id;

  if($getFromU->loggedIn() === false) {
    header('Location: '.BASE_URL.'index.php');
  }

$result = $pdo->delete($_GET['tweetID']);

?>
