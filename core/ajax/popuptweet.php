<?php
require_once '../init.php';

if (isset($_POST['tweetId']) and !empty($_POST['tweetId'])){
$records=$getfromT->getPopuptweet($_POST['tweetId']);
$comments=$getfromT->comments($_POST['tweetId']);

require_once 'popuptweetform.php';
}