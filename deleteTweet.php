<?php
require_once('core/class.php');

  $getFromU->loggedIn();
  $tweet_id = $_GET['id'];
  if($tweet->tweetBy === $user->$user_id){
    $getFromT->delete($tweet_id);
  }
  
  header('Location: home.php');
  exit();

?>