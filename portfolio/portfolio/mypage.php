<?php
require_once('core/class.php');

  $getFromU->loggedIn();
  
  if (isset($_GET['user_id']) === true && empty($_GET['user_id']) === false) {
    $profileId = $_GET['user_id'];
    $profileData = $getFromU->userData($profileId);
    $user_id = $_SESSION['user_id'];
    $user = $getFromU->userData($user_id);
 
  }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <title>twitter clone</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="assets/css/mypage.css"/>
    <link rel="stylesheet" href="assets/css/tweet.css"/>
    </head>
<!--Helvetica Neue-->
<body>
<div class="global-nav">
<nav>
  <ul>
    <li><a href="home.php">ホーム</a></li>
    <li><a href="mypage.php?user_id=<?php echo $user->user_id;?>">マイページ</a></li>
    <li><a href="public/logout.php">ログアウト</a></li>
  </ul>
</nav> 
</div>


<!---Inner wrapper-->
<div class="in-wrapper">
   <div class="profile-info-inner">
   <!-- PROFILE-IMAGE -->
    <div class="profile-box">
      <div class="profile-img">
        <img src="<?php echo $profileData->profileImage; ?>"/>
        <div class="profile-count">
          <div class="n-head">
            TWEETS
          </div>
          <div class="n-bottom">
            <?php $getFromT->countTweets($profileId); ?>
          </div>
        </div>
    </div>
   </div> 
    <div class="profile-box">
      <div class="profile-name-wrap">
        <label>名前</label>
        <div class="profile-name">
          <span><?php echo $profileData->username;?></span>
        </div>
      </div>
      <div class="profile-bio-wrap">
        <label>プロフィール</label>
       <div class="profile-bio-inner">
          <?php echo $profileData->bio; ?>
       </div>
      </div>
    </div>
  </div>
  <!--PROFILE INFO WRAPPER END-->
<!--Profile cover--> 
  <div class="edit-button">
    <?php
      if($profileId === $user_id){
        echo '<span><button class="button"><a href="mypage_edit.php">編集</a></button></span>';
      }
    ?>

  </div>

  <div class="tweets">
    <?php
      $tweets = $getFromT->getUserTweets($profileId);

      foreach ($tweets as $tweet){
        echo '<div class="all-tweet">
                <div class="tweet-show-wrapper"> 
                  <div class="tweet-show-inner">
                    <div class="tweet-show-head">
                      <div class="tweet-show-head-box">
                        <div class="tweet-show-profileimage">
                          <img src="'.$tweet->profileImage.'"/>
                        </div>
                        <div class="tweet-show-content">
                          <div class="tweet-show-name">
                            <span><a href="mypage.php?user_id='.$tweet->user_id.'">'.$tweet->username.'</a></span>
                            <span>@'.$tweet->username.'</span>
                            <span>'.$tweet->postedAt.'</span>
                          </div>
                        </div>
                      </div>
                    <div class="tweet-show-post">
                      <div class="tweet-show-text">
                        '.$tweet->tweetText.'
                      </div>';
                    echo '<img src="'.$tweet->tweetImage.'">
                      ';
                    if(isset($tweetImage)){
                      echo '<!--tweet show head end-->
                              <div class="tweet-show-body">
                                 <div class="tweet-show-tweetimage">
                                   <img src="'.$tweet->tweetImage.'"/>
                                 </div>
                              </div>
                              <!--tweet show body end-->';
                    }
                    
                    echo '</div><div class="tweet-show-footer">';
                          if($tweet->tweetBy === $user_id){
                            echo '<a href="deleteTweetMypage.php?id='.$tweet->tweetID.'">削除</a>';
                            }
                    echo '</div>
                        </div>
                      </div>
                    </div>
                </div>';
        }
      ?>
  </div>

  </div>
  <!-- in wrappper ends-->  
</body>
</html>
