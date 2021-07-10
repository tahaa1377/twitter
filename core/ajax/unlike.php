<?
require_once ('../init.php');
if (isset($_POST['userId']) && !empty($_POST['userId'])){
    $getfromT->removelike($_POST['userId'],$_POST['tweetId']);
}