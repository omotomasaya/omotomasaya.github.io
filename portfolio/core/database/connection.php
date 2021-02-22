<?php

  $user = 'root';
  $pass = 'root';

  $dsn = "mysql:host=localhost;dbname=twitterclone;charset=utf8mb4";

  try {
    $pdo = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
  } catch(PDOException $e){
    echo '接続失敗です'. $e->getMessage();
    exit();
  }

?>
