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