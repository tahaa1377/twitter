<?
require_once '../init.php';
if (isset($_POST['unfollow']) and !empty($_POST['unfollow'])){
    $result1=$getfromF->unfollow($_SESSION['user_id'],$_POST['unfollow']);
    echo json_encode($result1);
}

if (isset($_POST['follow']) and !empty($_POST['follow'])){
    $result=$getfromF->follow($_SESSION['user_id'],$_POST['follow']);
    echo json_encode($result);
}
