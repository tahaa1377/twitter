
<?php
require_once ('core/init.php');
if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])){
    header("Location: http://localhost/twitter/");
}


if (isset($_FILES['profileImage'])){
    if ($_FILES['profileImage']['size'] != 0){
            $getfromU->uploadeProfileImage($_FILES['profileImage']);
        }
}
if (isset($_FILES['profileCover'])){
    if ($_FILES['profileCover']['size'] != 0){
        $getfromU->uploadeCoverImage($_FILES['profileCover']);
    }
}
$data=$getfromU->userData($_SESSION['user_id']);
$profile=$data->username;


if (isset($_POST['screenName'])){
    if (empty($_POST['screenName'])){
        $error='you must have name';
    }else{

        if (strlen($_POST['screenName'])>20){
            $error='name is too long';
        }else if (strlen($_POST['bio'])>120){
            $error='bio is too long';
        }else if (strlen($_POST['country'])>40){
            $error='country is too long';
        }else{

            $getfromU->updateProfile($_POST['screenName'],$_POST['bio'],$_POST['country'],$_POST['website']);
            header("Location: http://localhost/twitter/profile.php?username=$profile");
        }
    }
}
$tweetCount=$getfromT->tweetCount($_SESSION['user_id']);
$likeCount=$getfromT->likeCount($_SESSION['user_id']);

?>
<html>
<head>
    <title>Profile edit page</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="assets/css/style-complete.css"/>
    <script src="assets/js/jquery-3.3.1.min.js" ></script>

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
                    </ul>
                </div>
                <!-- nav left ends-->
                <div class="nav-right">
                    <ul>

                        <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?=$data->profileImage?>"/></label>
                            <input type="checkbox" id="drop-wrap1">
                            <div class="drop-wrap">
                                <div class="drop-inner">
                                    <ul>
<!--                                        <li><a href="PROFILE-LINK">--><?//=$data->username?><!--</a></li>-->
                                        <li><a href="http://localhost/twitter/settings/account">Settings</a></li>
                                        <li><a href="http://localhost/twitter/logout">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- nav right ends-->
            </div>
            <!-- nav ends -->
        </div>
    </div>

    <div class="profile-cover-wrap">
        <div class="profile-cover-inner">
            <div class="profile-cover-img">
                <img src="<?=$data->profileCover?>"/>

                <div class="img-upload-button-wrap">
                    <div class="img-upload-button1">
                        <label for="cover-upload-btn">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </label>
                <span class="span-text1">
					Change your profile photo
				</span>
                        <input id="cover-upload-btn" type="checkbox"/>
                        <div class="img-upload-menu1">
                            <span class="img-upload-arrow"></span>
                            <form method="post" enctype="multipart/form-data">
                                <ul>
                                    <li>
                                        <label for="file-up">
                                            Upload photo
                                        </label>
                                        <input accept=".jpg,.png" type="file" name="profileCover" onchange="this.form.submit()" id="file-up" />
                                    </li>
                                    <li>
                                        <label for="cover-upload-btn">
                                            Cancel
                                        </label>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-nav">
            <div class="profile-navigation">
                <ul>
                    <li>
                        <a href="#">
                            <div class="n-head">
                                TWEETS
                            </div>
                            <div class="n-bottom">
                                <?=$tweetCount?>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="n-head">
                                FOLLOWINGS
                            </div>
                            <div class="n-bottom">
                                <?=$data->following?>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="n-head">
                                FOLLOWERS
                            </div>
                            <div class="n-bottom">
                                <?=$data->follower?>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="n-head">
                                LIKES
                            </div>
                            <div class="n-bottom">
                                <?=$likeCount?>
                            </div>
                        </a>
                    </li>

                </ul>
                <div class="edit-button">
			<span>
				<button class="f-btn" type="button" value="Cancel">Cancel</button>
			</span>
                    <span>
				<input type="submit" id="save" value="Save Changes">
			</span>

                </div>
            </div>
        </div>
    </div>

    <div class="in-wrapper">
        <div class="in-full-wrap">
            <div class="in-left">
                <div class="in-left-wrap">

                    <div class="profile-info-wrap">
                        <div class="profile-info-inner">
                            <div class="profile-img">

                                <img src="<?=$data->profileImage?>"/>
                                <div class="img-upload-button-wrap1">
                                    <div class="img-upload-button">
                                        <label for="img-upload-btn">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                        </label>
                                        <span class="span-text">
					                            Change your profile photo
				                                        </span>
                                        <input id="img-upload-btn" type="checkbox"/>
                                        <div class="img-upload-menu">
                                            <span class="img-upload-arrow"></span>
                                            <form method="post" enctype="multipart/form-data">
                                                <ul>
                                                    <li>
                                                        <label for="profileImage">
                                                            Upload photo
                                                        </label>
                                                        <input accept=".jpg,.png"  id="profileImage" type="file" onchange="this.form.submit()" name="profileImage"/>

                                                    </li>
                                                    <li><a href="#">Remove</a></li>
                                                    <li>
                                                        <label for="img-upload-btn">
                                                            Cancel
                                                        </label>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- img upload end-->
                                </div>
                            </div>

                            <form id="editForm" method="post" enctype="multipart/Form-data">
                                <div class="profile-name-wrap">

                                    <?if(!empty($errori)){?>
                                        <ul>
                                            <li class="error-li">
                                                <div class="span-pe-error"><?=$errori?></div>
                                            </li>
                                        </ul>
                                    <?}?>

                                    <div class="profile-name">
                                        <input type="text" name="screenName" value="<?=$data->screenName?>"/>
                                    </div>
                                    <div class="profile-tname">
                                        @<?=$data->username?>
                                    </div>
                                </div>
                                <div class="profile-bio-wrap">
                                    biography
                                    <div class="profile-bio-inner">

                                        <textarea class="status" name="bio"><?=$data->bio?></textarea>
                                        <div class="hash-box">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-extra-info">
                                    <div class="profile-extra-inner">
                                        <ul>
                                            <li>
                                                <div class="profile-ex-location">
                                                    <input id="cn" type="text" name="country" placeholder="Country" value="<?=$data->country?>" />
                                                </div>
                                            </li>
                                            <li>
                                                <div class="profile-ex-location">
                                                    <input type="text" name="website" placeholder="Website" value="<?=$data->webSite?>"/>
                                                </div>
                                            </li>
                                            <?if(!empty($error)){?>
                                                <ul>
                                                    <li class="error-li">
                                                        <div class="span-pe-error"><?=$error?></div>
                                                    </li>
                                                </ul>
                                            <?}?>
                            </form>
                            <script>
                                $('#save').click(function () {
                                  $('#editForm').submit();
                                });
                            </script>
                            </ul>
                        </div>
                    </div>
                    <div class="profile-extra-footer">
                        <div class="profile-extra-footer-head">
                            <div class="profile-extra-info">
                                <ul>
                                    <li>
                                        <div class="profile-ex-location-i">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                        </div>
                                        <div class="profile-ex-location">
                                            <a href="#">0 Photos and videos </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="profile-extra-footer-body">
                            <ul>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <div class="in-center">
        <div class="in-center-wrap">

        </div>

        <div class="popupTweet"></div>

    </div>


    <div class="in-right">
        <div class="in-right-wrap">

        </div>

    </div>


</div>


</div>


</div>
<!-- ends wrapper -->
</body>
</html>

