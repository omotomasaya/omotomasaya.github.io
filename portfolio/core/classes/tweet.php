<?php
  class Tweet extends User {

    function __construct($pdo){
      $this->pdo = $pdo;
    }

    public function tweets(){
      $user_id = $_SESSION['user_id'];
      $stmt = $this->pdo->prepare("SELECT * FROM tweets, users WHERE tweetBy = user_id ORDER BY `tweetID` DESC");
      $stmt->execute();
      $tweets = $stmt->fetchAll(PDO::FETCH_OBJ);
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
                            echo '<a href="deleteTweet.php?id='.$tweet->tweetID.'">削除</a>';
                            }
                    echo '</div>
                        </div>
                      </div>
                    </div>
                </div>';
      }
    }

    public function getUserTweets($user_id){
      $stmt = $this->pdo->prepare("SELECT * FROM tweets LEFT JOIN users ON tweetBy = user_id WHERE tweetBy = :user_id ORDER BY tweetID DESC");
      $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete($tweet_id){
      $stmt = $this->pdo->prepare('DELETE FROM tweets WHERE tweetID = :tweetID');
      $stmt->bindValue(':tweetID', $tweet_id);
      $stmt->execute();
    }

    public function countTweets($user_id){
      $stmt = $this->pdo->prepare("SELECT COUNT(tweetID) AS totalTweets FROM tweets WHERE tweetBy = :user_id");
      $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->execute();
      $count = $stmt->fetch(PDO::FETCH_OBJ);
      echo $count->totalTweets;
    }
  }
?>

