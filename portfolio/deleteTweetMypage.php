<?php
require_once('core/class.php');

  $getFromU->loggedIn();
  
  $user_id = $_SESSION['user_id'];
  $user = $getFromU->userData($user_id);
  $tweet_id = $_GET['id'];
  if($tweet->tweetBy === $user->$user_id){
    $getFromT->delete($tweet_id);
  }
  
  header('Location: mypage.php?user_id='.$user->user_id.'');
  exit();

?>
