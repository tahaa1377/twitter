<?php
require_once '../init.php';
if (isset($_POST['comment']) and !empty($_POST['comment'])){

$getfromT->addComment($_POST['tweet_id1'],$_POST['comment']);

    $comments=$getfromT->comments($_POST['tweet_id1']);
    require_once 'commentform.php';
}