<?

require_once ('core/init.php');
//if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])){
//    header('Location: http://localhost/twitter/');
//}
if (!empty($_REQUEST['username']) && isset($_REQUEST['username'])){
    $url =trim($_REQUEST['username']);
    $id=$getfromU->userDataByUsername($url);
    $profileData=$getfromU->userData($id);
    $followerlist=$getfromF->followerList($id);
    $count_film_photo=$getfromT->count_media();
}
?>


<html>
<head>
    <title>twitter</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="http://localhost/twitter/assets/css/style-complete.css?I"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <script src="assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
</head>
<!--Helvetica Neue-->
<body>
<div class="wrapper">
    <!-- header wrapper -->
    <div class="header-wrapper">
        <div class="nav-container">
            <div class="nav">
                <div class="nav-left">
                    <ul>
                        <li><a href="http://localhost/twitter/home"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>


                    </ul>
                </div><!-- nav left ends-->
                <div class="nav-right">
                    <ul>


                        <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="http://localhost/twitter/<?=$profileData->profileImage?>"/></label>
                            <input type="checkbox" id="drop-wrap1">
                            <div class="drop-wrap">
                                <div class="drop-inner">
                                    <ul>
                                        <li><a href="http://localhost/twitter/profile.php?username=<?=$profileData->username?>"><?=$profileData->username?></a></li>
                                        <li><a href="http://localhost/twitter/settings/account">Settings</a></li>
                                        <li><a href="http://localhost/twitter/logout">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- nav right ends-->

            </div><!-- nav ends -->
        </div><!-- nav container ends -->
    </div><!-- header wrapper end -->
    <!--Profile cover-->
    <div class="profile-cover-wrap">
        <div class="profile-cover-inner">
            <div class="profile-cover-img">
                <!-- PROFILE-COVER -->
                <img src="<?=$profileData->profileCover?>"/>
            </div>
        </div>
        <div class="profile-nav">
            <div class="profile-navigation">
                <ul>
                    <li>
                        <div class="n-head">
                            TWEETS
                        </div>
                        <div class="n-bottom">
                            <?=$getfromT->tweetCount($profileData->user_id)?>
                        </div>
                    </li>
                    <li>
                        <a href="http://localhost/twitter/following.php?username=<?=$profileData->username?>">
                            <div class="n-head">
                              FOLLOWING
                            </div>
                            <div class="n-bottom">
                                <span class="count-following"><?=$profileData->following?></span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/twitter/follower.php?username=<?=$profileData->username?>">
                            <div class="n-head">
                                FOLLOWERS
                            </div>
                            <div class="n-bottom">
                                <span class="count-followers"><?=$profileData->follower?></span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="n-head">
                                LIKES
                            </div>
                            <div class="n-bottom">
                                <?=$getfromT->likeCount($profileData->user_id)?>
                            </div>
                        </a>
                    </li>
                </ul>
                <script type="text/javascript" src="assets/js/follow.js?p"></script>

                <div class="edit-button">
		<span>
        <?$getfromF->followBtn($_SESSION['user_id'],$profileData->user_id)?>
		</span>
                </div>
            </div>
        </div>
    </div><!--Profile Cover End-->

    <!---Inner wrapper-->
    <div class="in-wrapper">
        <div class="in-full-wrap">
            <div class="in-left">
                <div class="in-left-wrap">
                    <!--PROFILE INFO WRAPPER END-->
                    <div class="profile-info-wrap">
                        <div class="profile-info-inner">
                            <!-- PROFILE-IMAGE -->
                            <div class="profile-img">
                                <img src="<?=$profileData->profileImage?>"/>
                            </div>

                            <div class="profile-name-wrap">
                                <div class="profile-name">
                                    <a href="http://localhost/twitter/profile.php?username=<?=$profileData->username?>"><?=$profileData->screenName?></a>
                                </div>
                                <div class="profile-tname">
                                    @<span class="username"><?=$profileData->username?></span>
                                </div>
                            </div>

                            <div class="profile-bio-wrap">
                                <div class="profile-bio-inner">
                                    <?=$profileData->bio?>
                                </div>
                            </div>

                            <div class="profile-extra-info">
                                <div class="profile-extra-inner">
                                    <ul>
                                        <li>
                                            <?if (!empty($profileData->country)){?>
                                            <div class="profile-ex-location-i">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </div>
                                            <div class="profile-ex-location">
                                                <?=$profileData->country?>
                                            </div>
                                            <?}?>
                                        </li>

                                        <li>
                                            <?if (!empty($profileData->webSite )){?>
                                            <div class="profile-ex-location-i">
                                                <i class="fa fa-link" aria-hidden="true"></i>
                                            </div>
                                            <div class="profile-ex-location">
                                                <a href="<?='https://'.$profileData->webSite?>" target="_blank"><?=$profileData->webSite?></a>
                                            </div>
                                            <?}?>
                                        </li>

                                        <li>
                                            <div class="profile-ex-location-i">
                                                <!-- <i class="fa fa-calendar-o" aria-hidden="true"></i> -->
                                            </div>
                                            <div class="profile-ex-location">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="profile-ex-location-i">
                                                <!-- <i class="fa fa-tint" aria-hidden="true"></i> -->
                                            </div>
                                            <div class="profile-ex-location">
                                            </div>
                                        </li>
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
                                                    <a href="#"><?=$count_film_photo->count_media?> Photos and videos </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="profile-extra-footer-body">
                                    <ul>
                                        <!-- <li><img src="#"/></li> -->
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!--PROFILE INFO INNER END-->

                    </div>
                    <!--PROFILE INFO WRAPPER END-->

                </div>
                <!-- in left wrap-->

            </div>
            <!-- in left end-->

            <div class="in-center">
                <div class="in-center-wrap">
                    <div class="follow-wrap"><div class="follow-inner"><div class="follow-title"><h3>follower list</h3></div>


                            <?
                            if ( !empty($followerlist)){
                            foreach ($followerlist as $item){?>
                                <div class="follow-body">
                                    <div class="follow-img">
                                        <img src="http://localhost/twitter/<?=$item['profileImage']?>"/>
                                    </div>
                                    <div class="follow-content">
                                        <div class="fo-co-head">
                                            <span><?=$item['screenName']?></span><br>
                                            <a href="http://localhost/twitter/profile.php?username=<?=$item['username']?>">@<?=$item['username']?></a>
                                        </div>
                                    </div>
                                </div>

                            <?}
                            }?>

                        </div>
                    </div>

                </div><!-- in left wrap-->
                <div class="popupTweet"></div>
            </div>
            <!-- in center end -->

            <div class="in-right">
                <div class="in-right-wrap">

                </div><!-- in right wrap-->
            </div>
            <!-- in right end -->

        </div>
        <!--in full wrap end-->
    </div>
    <!-- in wrappper ends-->
</div>
<!-- ends wrapper -->
</body>
</html>

