<?require_once('../init.php') ?>
<div class="retweet-popup">
    <div class="wrap5">
        <div class="retweet-popup-body-wrap">
            <div class="retweet-popup-heading">
                <h3>Retweet this to followers?</h3>
                <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
            </div>
            <div class="retweet-popup-input">
                <div class="retweet-popup-input-inner">
                    <input type="text" class="retweetMsg" placeholder="Add a comment.."/>
                </div>
            </div>
            <div class="retweet-popup-inner-body">
                <div class="retweet-popup-inner-body-inner">
                    <div class="retweet-popup-comment-wrap">
                        <div class="retweet-popup-comment-head">
                            <img src="<?=$record['profileImage']?>" alt=""/>
                        </div>
                        <div class="retweet-popup-comment-right-wrap">
                            <div class="retweet-popup-comment-headline">
                                <a href="http://localhost/twitter/profile.php?username=<?=$record['username']?>"><?=$record['screenName']?></a> &nbsp;&nbsp;<span><?=$record['username']?> - <?=$record['posedOn']?></span>
                            </div>
                            <div class="retweet-popup-comment-body">
                               <?=$getfromT->link($record['status'])?><br>
                                <br>
                                <? if (strpos($record['tweetImage'], '.mp4') !==  false){ ?>
                                    <video controls>
                                        <source src="http://localhost/twitter/<?=$record['tweetImage']?>">
                                    </video>
                                <?}else{?>
                                    <img src="http://localhost/twitter/<?=$record['tweetImage']?>" alt=""/>
                                <?}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="retweet-popup-footer">
                <div class="retweet-popup-footer-right">
                    <button class="retweet-it" type="submit"><i class="fa fa-retweet" aria-hidden="true"></i>Retweet</button>
                </div>
            </div>
        </div>
    </div>
</div>