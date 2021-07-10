<?
require_once ('core/init.php');
if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])){
    header('Location: ../');
}

$profileData=$getfromU->userData($_SESSION['user_id']);
if (isset($_POST['submit']) && !empty($_POST['submit'])){
    $usrname=$_POST['username'];
    $email=$_POST['email'];

    if (!empty($usrname) and !empty($email)){
        if (strlen($usrname)<4){
            $error['username']="'  $usrname  ' is too short";
        }else if ($profileData->username != $usrname and $getfromU->cheakUsername($usrname)=== true){
            $error['username']='username'.$usrname.'existed';
        }else if (preg_match("/[^a-zA-Z0-9]/",$usrname)){
            $error['username']='use only characters and numbers';
        }else if ($profileData->email != $email and $getfromU->cheakemail($email) === false){
            $error['email']="email  '$email'   existed";
        }else if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $error['email']="email format   '$email'   is wrong";
        }else{
            $getfromU->updateaccount($usrname,$email);
             $error['succeess']="change success";
        }
    }else{
        $error['filed']='all feiled requried';
    }
}

?>
<html>
<head>
    <title>Account settings page</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="http://localhost/twitter/https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="http://localhost/twitter/assets/css/style-complete.css"/>
</head>
<!--Helvetica Neue-->
<body>
<div class="wrapper">
    <!-- header wrapper -->
    <div class="header-wrapper">

        <div class="nav-container">
            <!-- Nav -->
            <div class="nav">
                <div class="nav-left">
                    <ul>
                        <li><a href="http://localhost/twitter/home"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
<!---->
                    </ul>
                </div>
                <!-- nav left ends-->
                <div class="nav-right">
                    <ul>

                        <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="http://localhost/twitter/<?=$profileData->profileImage?>"/></label>
                            <input type="checkbox" id="drop-wrap1">
                            <div class="drop-wrap">
                                <div class="drop-inner">
                                    <ul>
                                        <li><a href="http://localhost/twitter/profile.php?username=<?=$profileData->username?>"><?=$profileData->username?></a></li>
<!--                                        <li><a href="account">Settings</a></li>-->
                                        <li><a href="http://localhost/twitter/logout">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>


            </div>


        </div>
    </div>

    <div class="container-wrap">

        <div class="lefter">
            <div class="inner-lefter">

                <div class="acc-info-wrap">
                    <div class="acc-info-bg">

                        <img src="http://localhost/twitter/<?=$profileData->profileCover?>"/>
                    </div>
                    <div class="acc-info-img">

                        <img src="http://localhost/twitter/<?=$profileData->profileImage?>"/>
                    </div>
                    <div class="acc-info-name">
                        <h3><?=$profileData->screenName?></h3>
                        <span><a href="http://localhost/twitter/profile.php?username=<?=$profileData->username?>">@<?=$profileData->username?></a></span>
                    </div>
                </div>

                <div class="option-box">
                    <ul>
                        <li>
                            <a href="http://localhost/twitter/profileEdit" class="bold">
                                <div>
                                    ProfileEdit
                                    <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/twitter/password" class="bold">
                                <div>
                                    Password
                                    <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div><!--LEFTER ENDS-->

        <div class="righter">
            <div class="inner-righter">
                <div class="acc">
                    <div class="acc-heading">
                        <h2>Account</h2>
                        <h3>Change your basic account settings.</h3>
                    </div>
                    <div class="acc-content">
                        <form method="POST">
                            <div class="acc-wrap">
                                <div class="acc-left">
                                    USERNAME
                                </div>
                                <div class="acc-right">
                                    <input type="text" name="username" value="<?=$profileData->username?>"/>
                                    <span>
									<? if (isset($error['username'])){echo $error['username'];}?>
								</span>
                                </div>
                            </div>

                            <div class="acc-wrap">
                                <div class="acc-left">
                                    EMAIL
                                </div>
                                <div class="acc-right">
                                    <input type="text" name="email" value="<?=$profileData->email?>"/>
                                    <span>
									<? if (isset($error['email'])){echo $error['email'];}?>
								</span>
                                </div>
                            </div>
                            <div class="acc-wrap">
                                <div class="acc-left">

                                </div>
                                <div class="acc-right">
                                    <input type="Submit" name="submit" value="Save changes"/>
                                </div>

                                <div class="settings-error">
                                    <? if (isset($error['filed'])){echo $error['filed'];}else?>
                                        <span style="color: green">
                                        <? if (isset($error['succeess'])){echo $error['succeess'];}?>
                                            </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="content-setting">
                    <div class="content-heading">

                    </div>
                    <div class="content-content">
                        <div class="content-left">

                        </div>
                        <div class="content-right">

                        </div>
                    </div>
                </div>
            </div>
        </div><!--RIGHTER ENDS-->

    </div>
    <!--CONTAINER_WRAP ENDS-->

</div><!-- ends wrapper -->
</body>

</html>

