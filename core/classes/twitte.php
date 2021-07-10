<?php
class Twitte {
    protected $pdo;

    function __construct()
    {
        $dsn='mysql:host=localhost; dbname=tweeter';
        $root='root';
        $pass='';
        try{
            $this->pdo=new PDO($dsn,$root,$pass);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function uploadeTweetImage($file)
    {
        $name = $file['name'];
        $ext = explode(".", $name);
        $ext = strtolower(end($ext));
        if (in_array($ext, array('png', 'jpg', 'jpeg','mp4'))) {
            $tmp = $file['tmp_name'];
            move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'].'/twitter/assets/tweetImages/'.$name);
            return 'assets/tweetImages/'.$name;
        }else{
            $GLOBALS['errorImage']='extention not true';
        }
        return false;
    }

    public function addTweet($status, $pathroot, $user_id)
    {
        $stmt=$this->pdo->prepare("INSERT INTO `tweets`
            (`status`, `tweetImage`, `tweetBy`,`likesCount`) 
            VALUES (:email, :password, :screenName,0)");

        $stmt->bindParam(":email",$status);
        $stmt->bindParam(":password",$pathroot);
        $stmt->bindParam(":screenName",$user_id);

        $stmt->execute();
    }

    public function tweetData()
    {
        $db=$this->pdo->prepare("SELECT * FROM `tweets` LEFT OUTER JOIN `users` ON tweets.tweetBy=users.user_id where users.user_id=:userss or tweets.retweetBy=:userss
 OR tweets.tweetBy IN (SELECT follow.reciver FROM follow WHERE follow.sender=:userss)
 or tweets.retweetBy in (SELECT follow.reciver FROM follow WHERE follow.sender=:userss)");
        $db->bindParam(":userss",$_SESSION['user_id']);

        $db->execute();
        return $db->fetchAll(PDO::FETCH_OBJ);
    }



    public function getTrendsByHashtag($hashTag){
        $db=$this->pdo->prepare("SELECT * FROM trends WHERE hashTag LIKE :has limit 5");
        $hashTag1='%'.$hashTag.'%';
        $db->bindParam(":has",$hashTag1);
        $db->execute();
        return $db->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTendsByMention($mention){

        $db=$this->pdo->prepare("SELECT * FROM users WHERE screenName LIKE :has or username like :has limit 5");
        $hashTag1='%'.$mention.'%';
        $db->bindParam(":has",$hashTag1);
        $db->execute();
        return $db->fetchAll(PDO::FETCH_OBJ);

    }

    public function addTrend($trends){
        $my_regex="/#[a-zA-Z0-9]+/";
        preg_match_all($my_regex,$trends,$matches);
        $result=0;
        if ($matches){
            $result=count(array_values($matches[0]));
            $result1=array_values($matches[0]);
        }
        for ($i=0;$i<$result;$i++){
            $stmt=$this->pdo->prepare("INSERT INTO `trends` (hashTag) VALUES (:trnd)");
            $stmt->bindParam(":trnd",$result1[$i]);
            $stmt->execute();
        }
    }

    public function link($tweet){
        $tweet=preg_replace("/https?:\/\/[a-zA-Z0-9]+\.[a-zA-Z]+/",'<a href="$0" target="_blank">$0</a>',$tweet);
        $tweet=preg_replace("/#[a-zA-Z0-9]+/",'<a href="http://localhost/twitter/" target="_blank">$0</a>',$tweet);
        $tweet=preg_replace("/@([a-zA-Z0-9]+)/",'<a href="http://localhost/twitter/profile.php?username=$1" target="_blank">$0</a>',$tweet);
    return $tweet;
    }

    public function addlike($userId, $tweetId)
    {

        if ($this->likes($userId,$tweetId) == null) {


            $stmt = $this->pdo->prepare("UPDATE `tweets` SET likesCount=likesCount+1 WHERE tweet_id =:tweetId");
            $stmt->bindParam(":tweetId", $tweetId);
            $stmt->execute();

            $stmt1 = $this->pdo->prepare("INSERT INTO `likes` (likeBy, likeOn) VALUES (:userid,:tweetid)");
            $stmt1->bindParam(":userid", $userId);
            $stmt1->bindParam(":tweetid", $tweetId);
            $stmt1->execute();


            $stms=$this->pdo->prepare("SELECT `tweetBy` FROM `tweets` WHERE tweet_id=:tweet_id");
            $stms->bindParam(':tweet_id',$tweetId);
            $stms->execute();



            $this->send_notification($stms->fetch(PDO::FETCH_ASSOC)['tweetBy'],$userId,$tweetId,'like');




        }

    }

    public function send_notification($get_id,$user_id,$target,$type)
    {
        $stmt=$this->pdo->prepare("INSERT INTO `notification`(`notification_for`, `notification_from`, `target`, `type`, `status`)
                        VALUES (:get_id,:user_id,:target,:typee,0)");

        $stmt->bindParam(":get_id",$get_id);
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":target",$target);
        $stmt->bindParam(":typee",$type);
        $stmt->execute();

    }

    public function removelike($userId, $tweetId)
    {
        $stmt=$this->pdo->prepare("UPDATE `tweets` SET likesCount=likesCount-1 WHERE tweet_id =:tweetId");
        $stmt->bindParam(":tweetId",$tweetId);
        $stmt->execute();

        $stmt1=$this->pdo->prepare("DELETE FROM `likes` WHERE likeBy=:userid and likeOn=:tweetid");
        $stmt1->bindParam(":userid",$userId);
        $stmt1->bindParam(":tweetid",$tweetId);
        $stmt1->execute();
    }

    public function likes($user_id,$tweet_id){
        $stms=$this->pdo->prepare("SELECT * FROM `likes` WHERE likeBy=:user_id AND likeOn=:tweet_id");
        $stms->bindParam(':user_id',$user_id);
        $stms->bindParam(':tweet_id',$tweet_id);
        $stms->execute();

        return $stms->fetch(PDO::FETCH_ASSOC);

    }



    public function getPopuptweet($tweetId)
    {
        $db=$this->pdo->prepare("SELECT * FROM `tweets` LEFT OUTER JOIN `users` ON tweets.tweetBy=users.user_id where tweets.tweet_id=:id");
        $db->bindParam(":id",$tweetId);
        $db->execute();
        return $db->fetch(PDO::FETCH_ASSOC);
    }

    public function retweet($tweetId, $comment)
    {
        $stmt=$this->pdo->prepare("UPDATE `tweets` SET retweetCount=retweetCount+1 WHERE tweet_id=:tweetId");
        $stmt->bindParam(":tweetId",$tweetId);
        $stmt->execute();

    $stmt=$this->pdo->prepare(
"INSERT INTO `tweets` (`status`, `tweetBy`, `retweetId`, `retweetBy`, `tweetImage`, `likesCount`, `retweetCount`, `retweetMsg`)
    SELECT `status`, `tweetBy`, :retweetId, :retweetBy, `tweetImage`, `likesCount`, `retweetCount`, :retweetMsg
     FROM `tweets` WHERE tweet_id =:tweetId");

    $comment="'".$comment."'";
        $stmt->bindParam(":tweetId",$tweetId);
        $stmt->bindParam(":retweetBy",$_SESSION['user_id']);
        $stmt->bindParam(":retweetId",$tweetId);
        $stmt->bindParam(":retweetMsg",$comment);
        $stmt->execute();


        $user_id=$this->pdo->lastInsertId();

        $stms=$this->pdo->prepare("SELECT `tweetBy` FROM `tweets` WHERE tweet_id=:tweet_id");
        $stms->bindParam(':tweet_id',$user_id);
        $stms->execute();

        $this->send_notification($stms->fetch(PDO::FETCH_ASSOC)['tweetBy'],$_SESSION['user_id'],$tweetId,'retweet');

    }



    public function cheackReTweet($user_id,$tweet_id){
        $stms=$this->pdo->prepare("select * from `tweets` where retweetId=:tweet and retweetBy=:userr or tweet_id=:tweet and retweetBy=:userr");
        $stms->bindParam('tweet',$tweet_id);
        $stms->bindParam('userr',$user_id);
        $stms->execute();
        return $stms->fetch(PDO::FETCH_ASSOC);
    }

    public function comments($tweet_id){
        $db=$this->pdo->prepare("SELECT * FROM `comments` LEFT OUTER JOIN `users` ON users.user_id=comments.commentBy where comments.commentOn=:id");
        $db->bindParam(":id",$tweet_id);
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);

    }

    public function addComment($tweet_id,$comment){
        $stmt=$this->pdo->prepare("insert into `comments` (commentBy,commentOn,comment) values (:by1,:on1,:com)");
        $stmt->bindParam(":by1",$_SESSION['user_id']);
        $stmt->bindParam(":on1",$tweet_id);
        $stmt->bindParam(":com",$comment);
        $stmt->execute();
    }

    public function deletecomment($commentId)
    {
        $stmt=$this->pdo->prepare("DELETE FROM `comments` WHERE comment_id=:com");
        $stmt->bindParam(":com",$commentId);
        $stmt->execute();
    }

    public function deleteTweet($tweetId)
    {
        $stmt=$this->pdo->prepare("DELETE FROM `tweets` WHERE tweet_id=:com or retweetId=:com");
        $stmt->bindParam(":com",$tweetId);
        $stmt->execute();

        $stmt=$this->pdo->prepare("DELETE FROM `likes` WHERE likeOn=:com");
        $stmt->bindParam(":com",$tweetId);
        $stmt->execute();
    }

    public function tweetCount($tweet_by){
        $stmt=$this->pdo->prepare("SELECT COUNT(*) as total From `tweets` WHERE tweetBy=:tweetby or retweetBy=:tweetby");
        $stmt->bindParam(':tweetby',$tweet_by);
        $stmt->execute();

        $count1=$stmt->fetch(PDO::FETCH_ASSOC);
       return $count1['total'];
    }
    public function likeCount($user_id){
        $stmt=$this->pdo->prepare("SELECT COUNT(*) as total From `likes` WHERE likeBy=:tweetby");
        $stmt->bindParam(":tweetby",$user_id);
        $stmt->execute();

        $count1=$stmt->fetch(PDO::FETCH_ASSOC);
        return $count1['total'];
    }

    public function timeAgo($date){
        date_default_timezone_set('Asia/Tehran');
       $seconds= time() - strtotime($date);
       $minutes=round($seconds / 60);
       $hours=round($seconds/3600);
       $mounth=round($seconds/2592000);
       if ($seconds <= 60){
               return $seconds.'s';
       }else if ($minutes<=60){
           return $minutes.'m';
       }else if ($hours <= 24){
           return $hours.'h';
       }else if ($mounth <= 12){
           return date("M j",strtotime($date));
       }else{
           return date("j M Y",strtotime($date));
       }
    }

    public function getReTweet_info($retweetBy)
    {
        $stms=$this->pdo->prepare("SELECT * FROM `users` WHERE user_id=:re");
        $stms->bindParam(':re',$retweetBy);
        $stms->execute();

        return $stms->fetch(PDO::FETCH_ASSOC);
    }

    public function getLikeList($tweetId)
    {
        $db=$this->pdo->prepare("SELECT * FROM `likes` LEFT OUTER JOIN `users` ON users.user_id=likes.likeBy where likes.likeOn=:id");
        $db->bindParam(":id",$tweetId);
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count_media()
    {
        $db=$this->pdo->prepare("SELECT count(*) as count_media FROM `tweets` where tweetBy=:id");
        $db->bindParam(":id",$_SESSION['user_id']);
        $db->execute();
        return $db->fetch(PDO::FETCH_OBJ);
    }

    public function grouptrends()
    {

        $db=$this->pdo->prepare("SELECT trends.hashTag , COUNT(trends.hashTag) as hashTagCount FROM `trends` GROUP BY 
          trends.hashTag ORDER BY COUNT(trends.hashTag) DESC LIMIT 10");
        $db->execute();
        return $db->fetchAll(PDO::FETCH_OBJ);
    }
}