<?
//require_once ('database/connection.php');
require_once ('classes/user.php');
require_once ('classes/follow.php');
require_once ('classes/twitte.php');
require_once ('classes/message.php');

session_start();


$getfromU=new User();
$getfromF=new Follow();
$getfromT=new Twitte();
$getfromM=new Message();

