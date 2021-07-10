<?php
require_once ('core/init.php');
if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])){
    header('Location: http://localhost/twitter/');
}
$data=$getfromU->userData($_SESSION['user_id']);

if (isset($_POST['submit']) && !empty($_POST['submit'])){

    if (!empty($_POST['currentPwd']) && !empty($_POST['newPassword']) && !empty($_POST['rePassword']) ){

        $currentpass=$_POST['currentPwd'];
        $newpass=$_POST['newPassword'];
        $repass=$_POST['rePassword'];

        if ($getfromU->cheackpassword($currentpass) === false){
            $error['Current']="your current password is not this";
        }else if (strlen($newpass)<5){
            $error['newpass']="' $newpass '  is too short";
        }else if ($newpass != $repass){
            $error['repass']="passwords is not match";
        }else{
            $getfromU->updatePassword($newpass);
            $error['success']="changes success";
        }
    }else{
        $error['Fields']="all fields requaired";
    }

}

?>
<html>
<head>
    <title>Password settings page</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
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
                        <li><a href="i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification</a></li>
                        <li id="messagePopup" rel="user_id"><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
                    </ul>
                </div>
                <!-- nav left ends-->
                <div class="nav-right">
                    <ul>
                        <li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i></li>
                        <div class="nav-right-down-wrap">
                            <ul class="search-result">

                            </ul>
                        </div>
                        <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?=$data->profileImage?>"/></label>
                            <input type="checkbox" id="drop-wrap1">
                            <div class="drop-wrap">
                                <div class="drop-inner">
                                    <ul>
                                        <li><a href="http://localhost/twitter/profile"><?=$data->username?></a></li>
                                        <li><a href="http://localhost/twitter/settings/account">Settings</a></li>
                                        <li><a href="http://localhost/twitter/logout">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><label for="pop-up-tweet">Tweet</label></li>

                    </ul>
                </div>
                <!-- nav right ends-->

            </div>
            <!-- nav ends -->

        </div><!-- nav container ends -->
    </div><!-- header wrapper end -->
    <div class="container-wrap">
        <div class="lefter">
            <div class="inner-lefter">
                <div class="acc-info-wrap">
                    <div class="acc-info-bg">
                        <!-- PROFILE-COVER -->
                        <img src="<?=$data->profileCover?>"/>
                    </div>
                    <div class="acc-info-img">
                        <!-- PROFILE-IMAGE -->
                        <img src="<?=$data->profileImage?>"/>
                    </div>
                    <div class="acc-info-name">
                        <h3><?=$data->screenName?></h3>
                        <span><a href="http://localhost/twitter/profile">@<?=$data->username?></a></span>
                    </div>
                </div>
                <!--Acc info wrap end-->
                <div class="option-box">
                    <ul>
                        <li>
                            <a href="http://localhost/twitter/settings/account" class="bold">
                                <div>
                                    Account
                                    <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/twitter/profileEdit" class="bold">
                                <div>
                                    ProfileEdit
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
                        <h2>Password</h2>
                        <h3>Change your password or recover your current one.</h3>
                    </div>
                    <form method="POST">
                        <div class="acc-content">
                            <div class="acc-wrap">
                                <div class="acc-left">
                                    Current password
                                </div>
                                <div class="acc-right">
                                    <input type="password" name="currentPwd"/>
                                    <span>

                                         <? if (isset($error['Current'])){echo $error['Current'];}?>
							</span>
                                </div>
                            </div>

                            <div class="acc-wrap">
                                <div class="acc-left">
                                    New password
                                </div>
                                <div class="acc-right">
                                    <input type="password" name="newPassword" />
                                    <span>
							 <? if (isset($error['newpass'])){echo $error['newpass'];}?>
							</span>
                                </div>
                            </div>

                            <div class="acc-wrap">
                                <div class="acc-left">
                                    Verify password
                                </div>
                                <div class="acc-right">
                                    <input type="password" name="rePassword"/>
                                    <span>
								 <? if (isset($error['repass'])){echo $error['repass'];}?>
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
                                        <? if (isset($error['success'])){echo $error['success'];}?>
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
    </div>
    <!--RIGHTER ENDS-->
</div>
<!--CONTAINER_WRAP ENDS-->
</div>
<!-- ends wrapper -->
</body>
</html>

