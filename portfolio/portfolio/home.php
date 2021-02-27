<?php
require_once('core/class.php');

  $user_id = $_SESSION['user_id'];
  $user = $getFromU->userData($user_id);
  $tweetBy = $user_id;

  $getFromU->loggedIn();

  if(isset($_POST['tweet'])){
    $tweetText = $getFromU->checkInput($_POST['tweetText']);
    $image = '';

    if(!empty($tweetText) && !empty($_FILES['tweetImage']['name'])){
        if(strlen($tweetText) > 140){
          $error = "140文字以内にしてくだざい";
        }

        if(!empty($_FILES['tweetImage']['name'])){
          $tweetImage = $getFromU->uploadTextImage($_FILES['tweetImage'], $tweetBy, $tweetText);

        }
    }elseif(!empty($tweetText) or !empty($_FILES['tweetImage']['name'])){

      if(!empty($_FILES['tweetImage']['name'])){
        $tweetImage = $getFromU->uploadImage($_FILES['tweetImage'], $tweetBy);
      }

      if(!empty($tweetText)){

        if(strlen($tweetText) > 140){
          $error = "140文字以内にしてくだざい";
        }

        $getFromU->uploadText($tweetText, $tweetBy);
      }
    }else{
      $error = "画像もしくは文字を入力してください";
    }
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>twitter clone</title>
  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="assets/css/tweet.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js">
  </script>
  <meta charset="utf-8">
</head>
<body>
<header>
<div class="global-nav">
<nav>
  <ul>
    <li><a href="home.php">ホーム</a></li>
    <li><a href="mypage.php?user_id=<?php echo $user->user_id;?>">マイページ</a></li>
    <li><a href="public/logout.php">ログアウト</a></li>
  </ul>
</nav> 
</div>
</header>

<div class="main-wrapper">
  <div class="info-wrapper">
    <div class="info-box">
        <div class="info-image">
        <!-- PROFILE-IMAGE -->
          <img src="<?php echo $user->profileImage;?>" class="image">
        </div>
      <div class="info-name-box">
        <div class="info-name">
          <div><a href="mypage.php?user_id=<?php echo $user->user_id?>"><?php echo $user->username;?></a></div>
        </div><!-- in b name end-->
      </div><!-- info body name end-->
    </div><!-- info in body end-->
    <div class="number-wrapper">
      <div class="num-box">
        <div class="num-head">
          ツイート
        </div>
        <div class="num-body">
          <?php $getFromT->countTweets($user_id);?>
        </div>
      </div>
    </div><!-- mumber wrapper-->
  </div><!-- info inner end -->

  <div class="tweet-wrapper">
    <div class="tweet-box">
      <div class="tweet-post">
        <form method="post" enctype="multipart/form-data">
          <textarea class="tweet-text" name="tweetText" placeholder="ここに何か書いてみよう！" rows="4" cols="50"></textarea>
          <div class="tweet-footer">
            <div class="tweet-fo-left">
              <ul>
                <input type="file" name="tweetImage" id="tweetImage">
                <li>
                  <span class="tweet-error">
                    <?php if(isset($error)){echo $error;}else if(isset($imageError)){echo $imageError;}?>
                    </span>
                </li>
              </ul>
            </div>
            <div class="tweet-fo-right">
              <span id="count">140</span>
              <input type="submit" name="tweet" value="tweet" class="btn">
              <script type="text/javascript" src="assets/js/counter.js"></script>
            </div>
          </div>
        </form>    
        </div>
      </div>
      <div class="tweets">
        <?php $getFromT->tweets();?>
      </div>
    </div>

  </div>
</div>

</body>
</html>

