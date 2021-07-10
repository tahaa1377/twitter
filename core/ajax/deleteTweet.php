<?
require_once '../init.php';
if (isset($_POST['tweetId1']) && !empty($_POST['tweetId1'])){
    $getfromT->deleteTweet($_POST['tweetId1']);
}