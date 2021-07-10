<?php
require_once ('core/init.php');
if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])){
    header("Location: http://localhost/twitter/");
}
if (isset($_POST['tweet']) && !empty($_POST['tweet'])){
    if (!empty($_POST['status']) or $_FILES['file']['size'] !=0 ){
        if ($_FILES['file']['size'] !=0){
            if ($getfromT->uploadeTweetImage($_FILES['file'])!== false) {
                $pathroot = $getfromT->uploadeTweetImage($_FILES['file']);
                $getfromT->addTweet($_POST['status'],$pathroot,$_SESSION['user_id']);
                $getfromT->addTrend($_POST['status']);
                header("Location: http://localhost/twitter/home");
            }
        }else{
            $error='choose image';
        }
    }else{
        $error='fill status or choose image';
    }
}

$tweetCount=$getfromT->tweetCount($_SESSION['user_id']);
$notification_count=$getfromM->getNotifCount();
$trends=$getfromT->grouptrends();

?>
<html>
<head>
    <title>Tweety</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css?puXh1"/>
    <link rel="stylesheet" href="http://localhost/twitter/assets/css/style-complete.css?nxXd"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js?oh1" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="assets/js/jquery-3.3.1.min.js?oi9"></script>
    <script src="assets/js/home_ajax.js?bb"></script>

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
                        <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                        <li id="tahaaaaa">
                            <a>
                                <i style="font-size: 130%" class="fa fa-bell" aria-hidden="true"></i>Notification
                            <span id="notification"><?
                                if ($notification_count->no_count>0) {?>
                                <span class="span-i"><?=$notification_count->no_count?></span>
                                <?}?>
                            </span>
                            </a>
                        </li>

                    </ul>
                </div><!-- nav left ends-->

                <div class="nav-right">
                    <ul>
                        <li>
                            <input style="outline: none" type="text" placeholder="Search" class="search"/>
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <div class="search-result">
                                <span id="ajax_search_result"></span>
                            </div>
                        </li>

                        <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?= $getfromU->userData($_SESSION['user_id'])->profileImage ?>"/></label>
                            <input type="checkbox" id="drop-wrap1">
                            <div class="drop-wrap">
                                <div class="drop-inner">
                                    <ul>
                                        <li><a href="http://localhost/twitter/profile.php?username=<?=$getfromU->userData($_SESSION['user_id'])->username?>"><?= $getfromU->userData($_SESSION['user_id'])->username ?></a></li>
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

    <!---Inner wrapper-->
    <div class="inner-wrapper">
        <div class="in-wrapper">
            <div class="in-full-wrap">
                <div class="in-left">
                    <div class="in-left-wrap">
                        <div class="info-box">
                            <div class="info-inner">
                                <div class="info-in-head">
                                    <!-- PROFILE-COVER-IMAGE -->
                                    <img style="    height: inherit" src="http://localhost/twitter/<?= $getfromU->userData($_SESSION['user_id'])->profileCover ?>"/>
                                </div><!-- info in head end -->
                                <div class="info-in-body">
                                    <div class="in-b-box">
                                        <div class="in-b-img">
                                            <!-- PROFILE-IMAGE -->
                                            <img src="http://localhost/twitter/<?= $getfromU->userData($_SESSION['user_id'])->profileImage ?>"/>
                                        </div>
                                    </div><!--  in b box end-->
                                    <div class="info-body-name">
                                        <div class="in-b-name">
                                            <div><a href="http://localhost/twitter/profile.php?username=<?=$getfromU->userData($_SESSION['user_id'])->username?>"><?= $getfromU->userData($_SESSION['user_id'])->screenName ?></a></div>
                                            <span><small><a href="http://localhost/twitter/profile.php?username=<?=$getfromU->userData($_SESSION['user_id'])->username?>">@<?= $getfromU->userData($_SESSION['user_id'])->username ?></a></small></span>
                                        </div><!-- in b name end-->
                                    </div><!-- info body name end-->
                                </div><!-- info in body end-->
                                <div class="info-in-footer">
                                    <div class="number-wrapper">
                                        <div class="num-box">
                                            <div class="num-head">
                                                TWEETS
                                            </div>
                                            <div class="num-body">
                                                <?=$tweetCount?>
                                            </div>
                                        </div>
                                        <div class="num-box">
                                            <div class="num-head">
                                                FOLLOWING
                                            </div>
                                            <div class="num-body">
                                                <span class="count-following"><?= $getfromU->userData($_SESSION['user_id'])->following ?></span>
                                            </div>
                                        </div>
                                        <div class="num-box">
                                            <div class="num-head">
                                                FOLLOWERS
                                            </div>
                                            <div class="num-body">
                                                <span class="count-followers"><?= $getfromU->userData($_SESSION['user_id'])->follower ?></span>
                                            </div>
                                        </div>
                                    </div><!-- mumber wrapper-->
                                </div><!-- info in footer -->
                            </div><!-- info inner end -->
                        </div><!-- info box end-->

                        <div class="trend-wrapper">
                            <div class="trend-inner">
                                <div class="trend-title"><h3>Trends</h3></div><!-- trend title end-->
                                <? foreach ($trends as $trend){ ?>
                                <div class="trend-body">
                                    <div class="trend-body-content">
                                        <div class="trend-link">
                                            <a href=""><?=$getfromT->link($trend->hashTag)?></a>
                                        </div>
                                        <div class="trend-tweets">
                                           <?= $trend->hashTagCount ?> <span>tweets</span>
                                        </div>
                                    </div>
                                </div>
                                <!--Trend body end-->
                                <? } ?>
                            </div><!--TREND INNER END--></div><!--TRENDS WRAPPER ENDS-->

                    </div><!-- in left wrap-->
                </div><!-- in left end-->
                <div class="in-center">
                    <div class="in-center-wrap">
                        <!--TWEET WRAPPER-->
                        <div class="tweet-wrap">
                            <div class="tweet-inner">
                                <div class="tweet-h-left">
                                    <div class="tweet-h-img">
                                        <!-- PROFILE-IMAGE -->
                                        <img src="<?= $getfromU->userData($_SESSION['user_id'])->profileImage ?>"/>
                                    </div>
                                </div>
                                <div class="tweet-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <textarea style="outline: none" class="status" name="status" placeholder="Type tweet" rows="4" cols="50"></textarea>
                                        <div class="hash-box">
                                            <ul>

                                            </ul>
                                        </div>
                                </div>
                                <div class="tweet-footer">
                                    <div class="t-fo-left">
                                        <ul>
                                            <input type="file" name="file" id="file"/>
                                            <li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
                                                <div class="tweet-error" style="color: red">
                                                    <br>
                                                    <?if (!empty($error)){echo $error;}else if (!empty($errorImage)){echo $errorImage;}?>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="t-fo-right">
                                        <span id="count">250</span>
                                        <input type="submit" name="tweet" value="tweet"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!--TWEET WRAP END-->


                        <!--Tweet SHOW WRAPPER-->
                        <div class="tweets"><br>
                            <span id="tweets_show"></span>
                        </div>
                        <!--TWEETS SHOW WRAPPER-->

                        <div class="loading-div">
                            <img id="loader" src="assets/images/loading.svg" style="display: none;"/>
                        </div>
                        <div class="popupTweet">

                        </div>
                        <!--Tweet END WRAPER-->
                    <script src="assets/js/like.js?bbc"></script>
                    <script src="assets/js/retweet.js?b5f"></script>
                    <script src="assets/js/popuptweet.js?bvb"></script>
                    <script src="assets/js/comment.js?b56r"></script>
                    <script src="assets/js/tweetpopup.js?kloji"></script>
                    <script src="assets/js/message.js?sl"></script>
                    <script src="assets/js/notification.js"></script>
                    </div><!-- in left wrap-->
                </div><!-- in center end -->



            </div><!--in full wrap end-->

        </div><!-- in wrappper ends-->
    </div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->
</body>

</html>
