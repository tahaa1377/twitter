<?php
require_once '../init.php';

$records=$getfromM->notification();
require_once 'list_notifications_form.php';
$getfromM->seen_notification($_SESSION['user_id']);