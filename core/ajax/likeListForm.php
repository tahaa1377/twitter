<div class="retweet-popup">
    <div class="wrap5">
        <div class="retweet-popup-body-wrap">
            <div class="retweet-popup-heading">
                <h3>likes list</h3>
                <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
            </div>
            <div class="retweet-popup-inner-body">
                <div class="retweet-popup-inner-body-inner">
                    <div class="retweet-popup-comment-wrap">
                        <div class="retweet-popup-comment-head">
                        </div>
                        <div class="retweet-popup-comment-right-wrap">
                            <div class="retweet-popup-comment-headline">
                                <?foreach ($records as $re){

                                    ?>

                                    <div style="position: relative;margin: 10px 0">
                                        <img style="width: 90px;height: 90px;border-radius:100px" src="http://localhost/twitter/<?=$re['profileImage']?>">
                                       <span style="position: absolute;top: 20px;margin-left: 10px">
                                        <span style="color: black"> <?= $re['screenName']?></span>
                                        <a style="text-decoration-line: revert;color: darkblue" href="http://localhost/twitter/profile.php?username=<?=$re['username']?>">@<?= $re['username']?></a>
                                       </span>
                                    </div>
                                    <hr>


                                <?}?>
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
