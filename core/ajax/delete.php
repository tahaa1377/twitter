<?php
require_once '../init.php';
if (isset($_POST['commentId']) && !empty($_POST['commentId'])){
    $getfromT->deletecomment($_POST['commentId']);
}else if (isset($_POST['tweetId']) && !empty($_POST['tweetId'])){

    $records=$getfromT->getPopuptweet($_POST['tweetId']);
    require_once 'deleteform.php';
    //$getfromT->deleteTweet($_POST['tweetId']);

}