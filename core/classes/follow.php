<?php
class Follow{

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
   private function cheakfollow($user_id,$follow_id){
    $stmt=$this->pdo->prepare("select * from `follow` where sender=:user1 and reciver=:follow");
   $stmt->bindParam(':user1',$user_id);
   $stmt->bindParam(':follow',$follow_id);
   $stmt->execute();
   return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function followBtn($user_id,$proflie_id){
        $data =$this->cheakfollow($user_id,$proflie_id);
        if ($user_id != $proflie_id){
            if ($data['reciver'] == $proflie_id){

               echo '<button class="f-btn following-btn follow-btn"  data-follow="'.$proflie_id.'" data-user="'.$user_id.'"> Following </button>';

            }else{
                echo '<button class="f-btn follow-btn"  data-follow="'.$proflie_id.'" data-user="'.$user_id.'"><i class=\'fa fa-user-plus\'></i> Follow </button>';
            }

        }else{
            echo '<button onclick="location.href=\'profileEdit\'" class="f-btn"  data-follow="follow_id" data-user="user_id">Edit Profile</button>';
        }
    }

    public function follow($user_id,$follow_id){
        $stmt=$this->pdo->prepare("INSERT INTO `follow` (`sender`, `reciver`) VALUES (:email, :password)");
        $stmt->bindParam(":email",$user_id);
        $stmt->bindParam(":password",$follow_id);
        $stmt->execute();


        $this->send_notification($follow_id,$user_id,0,'follow');


        $this->addFollowing($user_id,$follow_id);

        $stmt1=$this->pdo->prepare("select * from `users` where user_id=:id");
        $stmt1->bindParam(":id",$follow_id);
        $stmt1->execute();
        return $stmt1->fetch(PDO::FETCH_ASSOC);

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

    private function addFollowing($user_id,$follow_id){
        $stms=$this->pdo->prepare("UPDATE `users` SET `following`=`following` + 1 where user_id=:userid");
        $stms->bindParam(':userid',$user_id);
        $stms->execute();

        $stms=$this->pdo->prepare("UPDATE `users` SET `follower`=`follower` + 1 where user_id=:followid");
        $stms->bindParam(':followid',$follow_id);
        $stms->execute();

    }
    private function removeFollowing($user_id,$follow_id){
        $stms=$this->pdo->prepare("UPDATE `users` SET `following`=`following` - 1 where user_id=:userid");
        $stms->bindParam(':userid',$user_id);
        $stms->execute();

        $stms=$this->pdo->prepare("UPDATE `users` SET `follower`=`follower` - 1 where user_id=:followid");
        $stms->bindParam(':followid',$follow_id);
        $stms->execute();

    }

    public function unfollow($user_id,$follow_id){
        $stmt=$this->pdo->prepare("delete from `follow` where sender=:u_id and reciver=:f_id");
        $stmt->bindParam(":u_id",$user_id);
        $stmt->bindParam(":f_id",$follow_id);
        $stmt->execute();

        $this->removeFollowing($user_id,$follow_id);

        $stmt1=$this->pdo->prepare("select * from `users` where user_id=:id");
        $stmt1->bindParam(":id",$follow_id);
        $stmt1->execute();
        return $stmt1->fetch(PDO::FETCH_ASSOC);
    }

    public function followList($id){
        $stmt=$this->pdo->prepare("SELECT reciver FROM  `follow` WHERE sender = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $ids=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($ids as $id1){
            $id1=$id1['reciver'];
        $stmt=$this->pdo->prepare("SELECT * FROM `users` LEFT OUTER JOIN `follow` ON users.user_id = follow.sender WHERE users.user_id = '$id1'");
            $stmt->execute();
            $arr[]=$stmt->fetch(PDO::FETCH_ASSOC);

        }
    return $arr;

    }

    public function followerList($id)
    {
        $stmt=$this->pdo->prepare("SELECT sender FROM  `follow` WHERE reciver = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $ids=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($ids as $id1){
            $id1=$id1['sender'];
            $stmt=$this->pdo->prepare("SELECT * FROM `users` LEFT OUTER JOIN `follow` ON users.user_id = follow.reciver WHERE users.user_id = '$id1'");
            $stmt->execute();
            $arr[]=$stmt->fetch(PDO::FETCH_ASSOC);

        }
        return $arr;

    }
}