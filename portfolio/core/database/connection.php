<?php
ini_set('display_errors', 1);
  $dsn = 'mysql:host=localhost; dbname=twitterclone';
  $user = 'root';
  $password = 'root';

  try{
    $pdo = new PDO($dsn, $user, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
  }catch(PDOException $e){
    echo '接続失敗' . $e->getMessage();
  }
?>
