<?php
require_once '../init.php';
$notification_count=$getfromM->getNotifCount();
echo json_encode(
    array('notif'=>$notification_count->no_count)
);