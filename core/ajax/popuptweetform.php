
<?require_once '../init.php'?>
<div class="tweet-show-popup-wrap">
    <input type="checkbox" id="tweet-show-popup-wrap">
    <div class="wrap4">
        <label for="tweet-show-popup-wrap">
            <div class="tweet-show-popup-box-cut">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
        </label>
        <div class="tweet-show-popup-box">
            <div class="tweet-show-popup-inner">
                <div class="tweet-show-popup-head">
                    <div class="tweet-show-popup-head-left">
                        <div class="tweet-show-popup-img">
                            <img src="http://localhost/twitter/<?=$records['profileImage']?>"/>
                        </div>
                        <div class="tweet-show-popup-name">
                            <div class="t-s-p-n">
                                <a href="<?=$records['username']?>">
                                    <?=$records['screenName']?>
                                </a>
                            </div>
                            <div class="t-s-p-n-b">
                                <a href="<?=$records['username']?>">
                                    @<?=$records['username']?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tweet-show-popup-head-right">
                        <button class="f-btn"><i class="fa fa-user-plus"></i> Follow </button>
                    </div>
                </div>
                <div class="tweet-show-popup-tweet-wrap">
                    <div class="tweet-show-popup-tweet">
                        <?=$records['status']?>
                    </div>
                    <div class="tweet-show-popup-tweet-ifram">
                        <img src="<?=$records['tweetImage']?>"/>
                    </div>
                </div>
                <div class="tweet-show-popup-footer-wrap">
                    <div class="tweet-show-popup-retweet-like">
                        <div class="tweet-show-popup-retweet-left">
                            <div class="tweet-retweet-count-wrap">
                                <div class="tweet-retweet-count-head">
                                    RETWEET
                                </div>
                                <div class="tweet-retweet-count-body">
                                    <?=$records['retweetCount']?>
                                </div>
                            </div>
                            <div class="tweet-like-count-wrap">
                                <div class="tweet-like-count-head">
                                    LIKES
                                </div>
                                <div class="tweet-like-count-body">
                                    <?=$records['likesCount']?>
                                </div>
                            </div>
                        </div>
                        <div class="tweet-show-popup-retweet-right">

                        </div>
                    </div>
                    <div class="tweet-show-popup-time">
                        <span><?=$records['posedOn']?></span>
                    </div>
                    <div class="tweet-show-popup-footer-menu">
                        <ul>
                            <li><button type="buttton"><i class="fa fa-share" aria-hidden="true"></i></button></li>
                            <li><button type="button"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"><?=$records['retweetCount']?></span></button></li>
                            <li><button type="button"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCount"><?=$records['likesCount']?></span></button></button></li>
                            <li>
                                <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <ul>
                                    <li><label class="deleteTweet" >Delete Tweet</label></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!--tweet-show-popup-inner end-->
            <div class="tweet-show-popup-footer-input-wrap">
                <div class="tweet-show-popup-footer-input-inner">
                    <div class="tweet-show-popup-footer-input-left">
                        <img src="<?=$records['profileImage']?>" alt=""/>
                    </div>

                    <div class="tweet-show-popup-footer-input-right">
                        <input data-idt="<?=$records['tweet_id']?>" id="commentField" type="text" name="comment"  placeholder="Reply to @<?=$records['username']?>">
                    </div>
                </div>
                <div class="tweet-footer">
                    <div class="t-fo-left">
                        <ul>
                            <li>
                                <!-- <label for="t-show-file"><i class="fa fa-camera" aria-hidden="true"></i></label>
                                <input type="file" id="t-show-file"> -->
                            </li>
                            <li class="error-li">
                            </li>
                        </ul>
                    </div>
                    <div class="t-fo-right">
                        <input type="submit" id="postComment">
                    </div>
                </div>
            </div><!--tweet-show-popup-footer-input-wrap end-->

            <div class="tweet-show-popup-comment-wrap">
                <div id="comments">

                    <?foreach ($comments as $comment){?>

                        <div class="tweet-show-popup-comment-box">
                            <div class="tweet-show-popup-comment-inner">
                                <div class="tweet-show-popup-comment-head">
                                    <div class="tweet-show-popup-comment-head-left">
                                        <div class="tweet-show-popup-comment-img">
                                            <img src="<?=$comment['profileImage']?>" alt="">
                                        </div>
                                    </div>
                                    <div class="tweet-show-popup-comment-head-right">
                                        <div class="tweet-show-popup-comment-name-box">
                                            <div class="tweet-show-popup-comment-name-box-name">
                                                <a href="http://localhost/twitter/profile.php?username=<?=$getfromU->userData($_SESSION['user_id'])->username?>"><?=$comment['screenName']?></a>
                                            </div>
                                            <div class="tweet-show-popup-comment-name-box-tname">
                                                <a href="http://localhost/twitter/profile.php?username=<?=$getfromU->userData($_SESSION['user_id'])->username?>">@<?=$comment['username']?> - <?=$comment['commentAt']?></a>
                                            </div>
                                        </div>
                                        <div class="tweet-show-popup-comment-right-tweet">
                                            <p><a href="http://localhost/twitter/profile.php?username=<?=$getfromU->userData($_SESSION['user_id'])->username?>">@<?=$comment['username']?></a> <?=$comment['comment']?></p>
                                        </div>
                                        <div class="tweet-show-popup-footer-menu">
                                            <ul>
                                                <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
                                                <li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                                <li>
                                                    <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <ul>
                                                        <li><label class="deleteCmment" data-commentid="<?=$comment['comment_id']?>">Delete comment</label></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--TWEET SHOW POPUP COMMENT inner END-->
                        </div>



                    <?}?>
                </div>

            </div>
            <!--tweet-show-popup-box ends-->
        </div>
