<?
class Message{

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

    public function recentMessage($user_id){
        $stmt=$this->pdo->prepare("SELECT * FROM `messages` LEFT OUTER JOIN `users` ON messageFrom = user_id WHERE messageTo = :useri ");
        $stmt->bindParam(':useri',$user_id);
        $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function getMessages($user_id, $chatId)
    {
        $stmt=$this->pdo->prepare("SELECT * FROM `messages` LEFT OUTER JOIN `users` ON messageFrom=user_id WHERE messages.messageTo = :userid AND messages.messageFrom =:tatafid OR messages.messageTo =:tatafid AND messages.messageFrom = :userid");
        $stmt->bindParam(":userid",$user_id);
        $stmt->bindParam(":tatafid",$chatId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertMessage($chatId1, $kmassege ,$image,$taraf)
    {
        $stmt=$this->pdo->prepare("INSERT INTO `messages`(message,messageTo,messageFrom,messageImage) VALUES (:tatafid,:tata,:userid,:img)");
        $stmt->bindParam(":userid",$chatId1);
        $stmt->bindParam(":tata",$taraf);
        $stmt->bindParam(":img",$image);
        $stmt->bindParam(":tatafid",$kmassege);
        $stmt->execute();
    }

    public function search($vall)
    {
        $vall='%'.$vall.'%';
        $stmt=$this->pdo->prepare("SELECT * FROM `users` WHERE username LIKE ?");
        $stmt->bindParam(1,$vall);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function uploadeMsgImage($file)
    {
        $name = $file['name'];
        $ext = explode(".", $name);
        $ext = strtolower(end($ext));
        if (in_array($ext, array('png', 'jpg', 'jpeg'))) {
            $tmp = $file['tmp_name'];
            move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'].'/twitter/assets/msgImages/'.$name);
            return 'assets/msgImages/'.$name;
        }else{
           return false;
        }
        return false;
    }


    public function getNotifCount()
    {
        $stmt=$this->pdo->prepare("SELECT COUNT(*) as no_count FROM `notification` WHERE notification_for	=:userid and status=0");
        $stmt->bindParam(":userid",$_SESSION['user_id']);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function seen_notification($user_id)
    {
        $stmt=$this->pdo->prepare("UPDATE `notification` SET `status` = 1 where `notification_for` =:userid");
        $stmt->bindParam(":userid",$user_id);
        $stmt->execute();

    }

    public function notification()
    {
        $stmt=$this->pdo->prepare("SELECT * FROM `notification`
        left join `users` on  `notification`.notification_from = `users`.user_id
        left join `tweets` on  `notification`.target = `tweets`.tweet_id
        left join `likes` on  `notification`.target = `likes`.likeOn
        left join `follow` on  `notification`.notification_from = `follow`.sender and `notification`.notification_for = `follow`.reciver
        WHERE `notification`.notification_for=:userid and `notification`.notification_from != :userid and 
        `notification`.status=0");

        $stmt->bindParam(":userid",$_SESSION['user_id']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

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

}