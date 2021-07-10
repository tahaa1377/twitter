<?php
require_once ('../init.php');

if (isset($_POST['tweetId']) && !empty($_POST['tweetId'])){
    $id=$_POST['tweetId'];
    $record=$getfromT->getPopuptweet($id);
    require_once ('../ajax/retweetform.php');
}

if (isset($_POST['mesg']) && !empty($_POST['mesg'])){
    $comment=$_POST['mesg'];
    $id1=$_POST['tweetId'];

    $getfromT->retweet($id1,$comment);
}