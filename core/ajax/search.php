<?php
require_once ('../init.php');

if (isset($_POST['searching']) && !empty($_POST['searching'])) {

    //ob_start();
    $records = $getfromU->ajaxsearch($_POST['searching']);
    require_once('../ajax/searechForm.php');
//   $re=ob_get_clean();
//    echo json_encode($re);
}