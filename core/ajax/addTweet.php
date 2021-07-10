<?php
require_once '../init.php';
if (isset($_POST) and !empty($_POST)){

    if (!empty($_POST['status']) or $_FILES['file']['size'] !=0 ){
        if ($_FILES['file']['size'] !=0){
            if ($getfromT->uploadeTweetImage($_FILES['file'])!== false) {
                $pathroot = $getfromT->uploadeTweetImage($_FILES['file']);
                $getfromT->addTweet($_POST['status'],$pathroot,$_SESSION['user_id']);
                $getfromT->addTrend($_POST['status']);
               // header("Location: http://localhost/twitter/home");
            }
        }else{
            $error='choose image';
        }
    }else{
        $error='fill status or choose image';
    }

    if (isset($error) and !empty($error)){

        echo json_encode($error);
    }
    if (!empty($errorImage)){
        echo json_encode($errorImage);
    }

}