<?
class User{
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

  function login($email,$password){
        $sem=$this->pdo->prepare("SELECT user_id FROM `users` WHERE email= :email AND password= :password");

        $password=md5($password);
        $sem->bindParam(':email',$email,PDO::PARAM_STR);
        $sem->bindParam(':password',$password);
        $sem->execute();

        $user_id=$sem->fetch(Pdo::FETCH_OBJ);
        $count=$sem->rowCount();

        if ($count>0){
            $_SESSION['user_id']=$user_id->user_id;
        }else{
            return false;
        }
        return true;
  }

  public function userData($userId){
      $db=$this->pdo->prepare('select * from `users` where user_id= :user_id');
      $db->bindParam(':user_id',$userId);
      $db->execute();
      return $db->fetch(PDO::FETCH_OBJ);
  }

  public function logout(){
        session_destroy();
        header('Location: http://localhost/twitter/');
  }

    public function cheakemail($email)
    {
        $stm=$this->pdo->prepare("select email from users where email= :email");
        $stm->bindParam(':email',$email);
        $stm->execute();

        if ($stm->rowCount()>0){
            return false;
        }
        return true;
    }

    public function register($fullname, $email, $password)
    {
        $stmt=$this->pdo->prepare("INSERT INTO `users`
            (`email`, `password`, `screenName`, `profileImage`, `profileCover`, `following`, `follower`) 
            VALUES (:email, :password, :screenName, 'assets/images/defaultprofileimage.png','assets/images/defaultCoverImage.png','0','0')");
         $password=md5($password);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":password",$password);
        $stmt->bindParam(":screenName",$fullname);

        $stmt->execute();

        $user_id=$this->pdo->lastInsertId();
        $_SESSION['user_id']=$user_id;
    }

    public function cheakUsername($username)
    {
        $stm=$this->pdo->prepare("select username from users where username= :username");
        $stm->bindParam(':username',$username);
        $stm->execute();

        if ($stm->rowCount()>0){
            return true;
        }
        return false;
    }

    public function addUseranem($username)
    {
        $stmt=$this->pdo->prepare("UPDATE `users` SET username= :username where user_id= :user_id");

        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":user_id",$_SESSION['user_id']);

        $stmt->execute();

    }

    public function updateProfile($screenName, $bio, $country, $website)
    {
        $stmt=$this->pdo->prepare("UPDATE `users` SET screenName= :screenName,bio= :bio,country= :country,website= :website where user_id= :user_id");

        $stmt->bindParam(":screenName",$screenName);
        $stmt->bindParam(":bio",$bio);
        $stmt->bindParam(":country",$country);
        $stmt->bindParam(":website",$website);
        $stmt->bindParam(":user_id",$_SESSION['user_id']);

        $stmt->execute();
    }

    public function uploadeProfileImage($profileImage)
    {
        $extention=explode('.',$profileImage['name']);
        $extention=strtolower(end($extention));
        $arr=array('png','jpg','jpeg');
        if (in_array($extention,$arr)){

           $path='assets/images/'.$profileImage['name'];
            move_uploaded_file($profileImage['tmp_name'],$path);

            $stmt=$this->pdo->prepare("UPDATE `users` SET profileImage= :profileImages where user_id= :user_id");

            $stmt->bindParam(":profileImages",$path);
            $stmt->bindParam(":user_id",$_SESSION['user_id']);
            $stmt->execute();
        }else{
            $GLOBALS['errori']="extention not true";
        }
   }
    public function uploadeCoverImage($profileImage)
    {
        $extention=explode('.',$profileImage['name']);
        $extention=strtolower(end($extention));
        $arr=array('png','jpg','jpeg');
        if (in_array($extention,$arr)){

            $path='assets/images/'.$profileImage['name'];
            move_uploaded_file($profileImage['tmp_name'],$path);

            $stmt=$this->pdo->prepare("UPDATE `users` SET profileCover= :profileImages where user_id= :user_id");

            $stmt->bindParam(":profileImages",$path);
            $stmt->bindParam(":user_id",$_SESSION['user_id']);
            $stmt->execute();
        }else{
            $GLOBALS['errori']="extention not true";
        }
    }

    public function updateaccount($usrname, $email)
    {
        $stmt=$this->pdo->prepare("UPDATE `users` SET username= :username,email= :email where user_id= :user_id");

        $stmt->bindParam(":username",$usrname);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":user_id",$_SESSION['user_id']);

        $stmt->execute();
    }

    public function cheackpassword($currentpass)
    {
        $currentpass=md5($currentpass);
        $stm=$this->pdo->prepare("select password from users where password= :password");
        $stm->bindParam(':password',$currentpass);
        $stm->execute();

     $DATA=$stm->fetch(PDO::FETCH_OBJ);

     if ($currentpass == $DATA->password){
         return true;
     }
    return false;
    }

    public function updatePassword($newpass)
    {
        $newpass=md5($newpass);
        $stmt=$this->pdo->prepare("UPDATE `users` SET password= :password where user_id= :user_id");
        $stmt->bindParam(":password",$newpass);
        $stmt->bindParam(":user_id",$_SESSION['user_id']);
        $stmt->execute();
    }

    public function ajaxsearch($ajax_search){
        $SREEN='%'.$ajax_search.'%';
        $USER= '%'.$ajax_search.'%';

        $stm=$this->pdo->prepare("select * from users where username like ? or screenName like ?");
        $stm->bindParam(1,$SREEN);
        $stm->bindParam(2,$USER);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function userDataByUsername($username)
    {
        $db=$this->pdo->prepare('select user_id from `users` where username= :username');
        $db->bindParam(':username',$username);
        $db->execute();
         $data=$db->fetch(PDO::FETCH_OBJ);
         return $data->user_id;
    }



}