<?
require_once ('../init.php');
foreach ($records as $record){


    $likes=$getfromT->likes($_SESSION['user_id'],$record->tweet_id);
    $retweet=$getfromT->cheackReTweet($record->user_id,$record->tweet_id);
    ?>
<!--    --><?//=$record->user_id?>
<!--    --><?//=$record->tweet_id?>
    <div class="all-tweet">
        <div class="t-show-wrap">
            <div class="t-show-inner">
                <?if ($retweet['retweetId'] === $record->tweet_id){ ?>
                <div class="t-show-banner">
                    <div class="t-show-banner-inner">
                        <span>
                            <i class="fa fa-retweet" aria-hidden="true"></i>
                            </span>
                        <span>Screen-Name Retweeted</span>
                    </div>
                </div>
                <?}else{?>
                    <div class="t-show-banner">
                        <div class="t-show-banner-inner">
                        <span>
                            <i class="fa fa-retweet" aria-hidden="true"></i>
                            </span>
                            <span><?=$record->screenName?> Retweeted</span>
                        </div>
                    </div>
                <?}?>


                <div class="t-show-popup" data-tweet="<?=$record->tweet_id?>">
                    <div class="t-show-head">
                        <div class="t-show-img">
                            <img src="<?=$record->profileImage?>"/>
                        </div>
                        <div class="t-s-head-content">
                            <div class="t-h-c-name">
                                <span><a href="http://localhost/twitter/profile.php?username=<?=$record->username?>"><?=$record->screenName?></a></span>
                                <span>@<?=$record->username?></span>
                                <span><?=$getfromT->timeAgo($record->posedOn)?></span>
                            </div>
                            <div class="t-h-c-dis">
                                <?=$getfromT->link($record->status)?>
                            </div>
                        </div>
                    </div>
                    <!--tweet show head end-->
                    <div class="t-show-body">
                        <div class="t-s-b-inner">
                            <div class="t-s-b-inner-in">
                                <? if (strpos($record->tweetImage, '.mp4') !==  false){ ?>
                                    <video data-id="<?=$record->tweet_id?>" controls>
                                        <source src="<?=$record->tweetImage?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                <?}else{?>
                                    <img style="height: 200px" src="<?=$record->tweetImage?>" class="imagePopup" data-id="<?=$record->tweet_id?>"/>
                                <?}?>
                            </div>
                        </div>
                    </div>
                    <?if(!empty($record->retweetMsg)){
                        $retweet_d=$getfromT->getReTweet_info($record->retweetBy);
                        ?>

                        <div class="t-show-head">
                            <div class="t-show-img">
                                <img src="<?=$retweet_d['profileImage']?>"/>
                            </div>
                            <div class="t-s-head-content">
                                <div class="t-h-c-name">
                                    <span><a href="http://localhost/twitter/profile.php?username=<?=$retweet_d['username']?>">Retweet by <?=$retweet_d['screenName']?></a></span><br>
                                    <span>@<?=$retweet_d['username']?></span><br>
                                    <span><?=$record->posedOn?></span>
                                </div>
                                <div class="t-h-c-dis">
<!--                                    RETWEET-COMMENT-->
                                </div>
                            </div>
                        </div>
                        <div class="t-s-b-inner">
                            <div class="t-s-b-inner-in">
                                <div class="retweet-t-s-b-inner">
                                    <div class="retweet-t-s-b-inner-left">
                                        <? if (strpos($record->tweetImage, '.mp4') !==  false){ ?>
                                            <video width="130" height="100" >
                                                <source src="http://localhost/twitter/<?=$record->tweetImage?>">
                                            </video>
                                        <?}else{?>
                                            <img src="<?=$record->tweetImage?>" alt=""/>
                                        <?}?>
                                        
                                    </div>
                                    <div class="retweet-t-s-b-inner-right">
                                        <div class="t-h-c-name">
                                            <span><a href="#"> <?=$record->screenName?></a></span>
                                            <span>@ <?=$record->username?></span>
                                            <span> <?=$retweet['posedOn']?></span>
                                        </div>
                                        <div class="retweet-t-s-b-inner-right-text">
                                            <?=$record->retweetMsg?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?}?>
                </div>
                <div class="t-show-footer">

                    <div class="t-s-f-right" style="margin: auto">

                        <ul>
<!--                            <li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>-->
                            <li>
<!--                                --><?//if ($retweet['retweetId'] === $record->tweet_id){ ?>
<!--                                    ddd-->
<!--                                <span class="retweeted" data-tweet="--><?//=$record->tweet_id?><!--" data-user="--><?//=$record->user_id?><!--">-->
<!--                                    <i class="fa fa-retweet" aria-hidden="true"></i>-->
<!--                                    <span class="retweet_counter">--><?//if($record->retweetCount>0){?><!----><?//=$record->retweetCount?><!----><?//}?><!--</span>-->
<!--                                </span>-->
<!--                                --><?//}else{?>
                                    <span class="retweet" data-tweet="<?=$record->tweet_id?>" data-user="<?=$record->user_id?>">
                                    <i class="fa fa-retweet" aria-hidden="true"></i>
                                    <span class="retweet_counter"><?if($record->retweetCount>0){?><?=$record->retweetCount?><?}?></span>
                                </span>
<!--                                --><?//}?>
                            </li>
                            <li>
                                <?if($likes['likeBy'] === $_SESSION['user_id']){?>
<!--                                    likeBy--><?//=$likes['likeBy']?>
<!--                                    user_id--><?//=$_SESSION['user_id']?>
                                    <span class="unlike-btn" data-userid="<?=$_SESSION['user_id']?>" data-tweetid="<?=$record->tweet_id?>">
                                    <a><i style="color: red" class="fa fa-heart" aria-hidden="true"></i>
                                        <span class="counter"><?if($record->likesCount>0){?><?=$record->likesCount?><?}?></span>
                                    </a>
                                   </span>
                                    <ul>
                                        <li><label class="likeList" data-tweetid="<?=$record->tweet_id?>">like list</label></li>
                                    </ul>
                                <?}else{?>
<!--                                    likeBy--><?//=$likes['likeBy']?>
<!--                                    user_id--><?//=$_SESSION['user_id']?>
                                    <span class="like-btn" data-userid="<?=$_SESSION['user_id']?>" data-tweetid="<?=$record->tweet_id?>">
                                    <a><i style="color: red" class="fa fa-heart-o" aria-hidden="true" ></i>
                                        <span class="counter"><?if($record->likesCount>0){?><?=$record->likesCount?><?}?></span>
                                    </a>
                                    </span>
                                    <ul>
                                        <li><label class="likeList" data-tweetid="<?=$record->tweet_id?>">like list</label></li>
                                    </ul>
                                <?}?>
                            </li>
                            <li>
                                <a  class="more"><i style="font-size: 120%" class="fa fa-trash" aria-hidden="true"></i></a>
                                <ul>
                                    <li><label class="deleteTweet" data-tweetid="<?=$record->tweet_id?>">Delete Tweet</label></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
<br>
<br>
                </div>
                <br>
            </div> <br>
        </div>
    </div>
<?}?>

<br>
<br>
