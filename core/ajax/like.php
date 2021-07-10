<?
require_once ('../init.php');
if (isset($_POST['userId']) && !empty($_POST['userId'])){
    $getfromT->addlike($_POST['userId'],$_POST['tweetId']);
}