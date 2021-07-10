<div class="img-popup">
    <div class="wrap6">
<span class="colose">
	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
</span>
        <div class="img-popup-wrap">
            <div class="img-popup-body">
                <img src="<?=$record['tweetImage']?>"/>
            </div>
            <div class="img-popup-footer">
                <div class="img-popup-tweet-wrap">
                    <div class="img-popup-tweet-wrap-inner">
                        <div class="img-popup-tweet-left">
                            <img src="<?=$record['profileImage']?>"/>
                        </div>
                        <div class="img-popup-tweet-right">
                            <div class="img-popup-tweet-right-headline">
                                <a href="PROFILE-LINK"><?=$record['screenName']?></a><span>@<?=$record['username']?> - <?=$record['posedOn']?></span>
                            </div>
                            <div class="img-popup-tweet-right-body">
                                <?=$record['status']?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="img-popup-tweet-menu">
                    <div class="img-popup-tweet-menu-inner">
                        <ul>
                            <li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
                            <li><button class="retweet"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span></button></li>
                            <li><button class="like-btn"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter"></span></button></li>

                            <li><label for="img-popup-menu"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></label>
                                <input id="img-popup-menu" type="checkbox"/>
                                <div class="img-popup-footer-menu">
                                    <ul>
                                        <li><label class="deleteTweet" >Delete Tweet</label></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>