<div class="retweet-popup">
    <div class="wrap5">
        <div class="retweet-popup-body-wrap">
            <div class="retweet-popup-heading">
                <h3>Are you sure you want to delete this Tweet?</h3>
                <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
            </div>
            <div class="retweet-popup-inner-body">
                <div class="retweet-popup-inner-body-inner">
                    <div class="retweet-popup-comment-wrap">
                        <div class="retweet-popup-comment-head">
                            <img src="http://localhost/twitter/<?=$records['profileImage']?>"/>
                        </div>
                        <div class="retweet-popup-comment-right-wrap">
                            <div class="retweet-popup-comment-headline">
                                <a>  <?=$records['screenName']?> </a><span>‏@<?=$records['username']?> <?=$records['posedOn']?></span>
                            </div>
                            <div class="retweet-popup-comment-body">
                                <?=$records['status']?>
                                <img src="<?=$records['tweetImage']?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="retweet-popup-footer">
                <div class="retweet-popup-footer-right">
                    <button class="cancel-it f-btn">Cancel</button><button class="delete-it" type="submit">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
