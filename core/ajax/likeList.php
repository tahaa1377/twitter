<?
require_once '../init.php';
if (isset($_POST['tweetId']) && !empty($_POST['tweetId'])){

    $records=$getfromT->getLikeList($_POST['tweetId']);
    require_once 'likeListForm.php';

}