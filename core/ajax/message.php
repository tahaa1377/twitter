<?php
require_once '../init.php';

if (isset($_POST['showMessage']) and !empty($_POST['showMessage'])){
    $mess=$getfromM->recentMessage($_SESSION['user_id']);
    require_once 'messageForm.php';
}else if (isset($_POST['ip']) and !empty($_POST['ip'])){
    $QQ=$_POST['chatId'];
    require_once 'chatform.php';
}else if (isset($_POST['chatId1']) and !empty($_POST['chatId1']) and !empty($_POST['kmassege'])) {
    $getfromM->insertMessage($_POST['chatId1'],$_POST['kmassege'],$_POST['chatId2']);
}else if (isset($_POST['ip1']) and !empty($_POST['ip1'])){
    $chats=$getfromM->getMessages($_SESSION['user_id'],$_POST['chatId']);
    require_once 'chatform1.php';
}else if (isset($_POST['vall']) and !empty($_POST['vall'])){
    $records=$getfromM->search($_POST['vall']);
    require_once 'searchMsg.php';
}
