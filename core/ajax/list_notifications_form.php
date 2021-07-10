




<div class="retweet-popup">
    <div class="wrap5">
        <div class="retweet-popup-body-wrap">
            <div class="retweet-popup-heading">
                <h3>notification list</h3>
                <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
            </div>
            <div class="retweet-popup-inner-body">
                <div class="retweet-popup-inner-body-inner">
                    <div class="retweet-popup-comment-wrap">
                        <div class="retweet-popup-comment-head">
                        </div>
                        <div class="retweet-popup-comment-right-wrap">
                            <div class="retweet-popup-comment-headline">



                                <!--NOTIFICATION WRAPPER FULL WRAPPER-->
                                <div class="notification-full-wrapper" >


                                    <? foreach ($records as $record){ ?>

                                        <? if ($record->type == 'follow'){ ?>
                                    <!-- Follow Notification -->
                                    <!--NOTIFICATION WRAPPER-->
                                    <div class="notification-wrapper">
                                        <div class="notification-inner">
                                            <div class="notification-header">

                                                <div class="notification-img">
				<span class="follow-logo">
					<i class="fa fa-child" aria-hidden="true"></i>
				</span>
                                                </div>
                                                <div class="notification-name">
                                                    <div>
                                                        <img src="http://localhost/twitter/<?=$record->profileImage?>"/>
                                                    </div>

                                                </div>
                                                <div class="notification-tweet">
                                                    <a href="http://localhost/twitter/profile.php?username=<?=$record->username?>"
                                                       class="notifi-name"><?=$record->screenName?></a><span> Followed you - <span><?=$record->time?></span>

                                                </div>

                                            </div>

                                        </div>
                                        <!--NOTIFICATION-INNER END-->
                                    </div>
                                    <!--NOTIFICATION WRAPPER END-->
                                    <!-- Follow Notification -->
                                    <?}elseif ($record->type == 'like'){?>

                                    <!-- Like Notification -->
                                    <!--NOTIFICATION WRAPPER-->
                                    <div class="notification-wrapper" >
                                        <div class="notification-inner">
                                            <div class="notification-header">
                                                <div class="notification-img">
				<span class="heart-logo">
					<i class="fa fa-heart" aria-hidden="true"></i>
				</span>
                                                </div>
                                                <div class="notification-name">
                                                    <div>
                                                        <img src="http://localhost/twitter/<?=$record->profileImage?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="notification-tweet">
                                                <a href="http://localhost/twitter/profile.php?username=<?=$record->username?>" class="notifi-name"><?=$record->screenName?></a><span> liked your
                                                    <?if ($record->tweetBy == $_SESSION['user_id']){ echo 'TWEET';}else echo 'RETWEET'?>  - <span><?=$record->time?></span>
                                            </div>
                                            <div class="notification-footer">
                                                <div class="noti-footer-inner">
                                                    <div class="noti-footer-inner-left">
                                                        <div class="t-h-c-name">
                                                            <span><a href="http://localhost/twitter/profile.php?username=<?=$record->username?>"><?=$record->screenName?></a></span>
                                                            <span>@<?=$record->username?></span>
                                                            <span><?=$record->posedOn?></span>
                                                        </div>
                                                        <div class="noti-footer-inner-right-text">
                                                            <?=$record->status?>
                                                        </div>
                                                    </div>
                                                    <?if(!empty($record->tweetImage)){?>
                                                    <div class="noti-footer-inner-right">
                                                <? if (strpos($record->tweetImage, '.mp4') !==  false){ ?>
                                                    <br>
                                                    <video style="float: inherit" height="200px" controls>
                                                        <source src="http://localhost/twitter/<?=$record->tweetImage?>">
                                                    </video>
                                                    <?}else{?>
                                                    <img src="http://localhost/twitter/<?=$record->tweetImage?>"/>
                                                    <?}?>
                                                    </div>
                                                      <?}?>

                                                </div><!--END NOTIFICATION-inner-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--NOTIFICATION WRAPPER END-->
                                    <!-- Like Notification -->
                                    <?}elseif ($record->type == 'retweet'){ ?>

                                    <!-- Retweet Notification -->
                                    <!--NOTIFICATION WRAPPER-->
                                    <div class="notification-wrapper">
                                        <div class="notification-inner">
                                            <div class="notification-header">

                                                <div class="notification-img">
                                                    <span class="retweet-logo">
                                                        <i class="fa fa-retweet" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                <div class="notification-tweet">
                                                    <a href="http://localhost/twitter/profile.php?username=<?=$record->username?>" class="notifi-name"><?=$record->screenName?></a><span> retweet your
                                                         <?if ($record->tweetBy == $_SESSION['user_id']){ echo 'TWEET';}else echo 'RETWEET'?>- <span><?=$record->time?></span>
                                                </div>
                                                <div class="notification-footer">
                                                    <div class="noti-footer-inner">

                                                        <div class="noti-footer-inner-left">
                                                            <div class="t-h-c-name">
                                                                <span><a href="http://localhost/twitter/profile.php?username=<?=$record->username?>"><?=$record->screenName?></a></span>
                                                                <span>@<?=$record->username?></span>
                                                                <span><?=$record->posedOn?></span>
                                                            </div>
                                                            <div class="noti-footer-inner-right-text">
                                                                <?=$record->status?>
                                                            </div>
                                                        </div>


                                                        <?if(!empty($record->tweetImage)){?>
                                                            <div class="noti-footer-inner-right">
                                                                <br>
                                                                <? if (strpos($record->tweetImage, '.mp4') !==  false){ ?>
                                                                    <video style="float: inherit;height: 200px"  controls>
                                                                        <source src="http://localhost/twitter/<?=$record->tweetImage?>">
                                                                    </video>
                                                                <?}else{?>
                                                                    <img src="http://localhost/twitter/<?=$record->tweetImage?>"/>
                                                                <?}?>
                                                            </div>
                                                        <?}?>

                                                    </div><!--END NOTIFICATION-inner-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--NOTIFICATION WRAPPER END-->
                                    <!-- Retweet Notification -->

                                    <?}
                                        }?>
                                </div>
                                <!--NOTIFICATION WRAPPER FULL WRAPPER END-->





                            </div>
                            <div class="retweet-popup-comment-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="retweet-popup-footer">
                <div class="retweet-popup-footer-right">
                    <button style="margin: 10px" class="cancel-it f-btn">close</button>

                </div>
            </div>
        </div>
    </div>
</div>
