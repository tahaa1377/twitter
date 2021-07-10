<?php
require_once '../init.php';

if (isset($_POST) and !empty($_POST)){

    if (!empty($_POST['msg']) and $_FILES['msg-upload']['size'] ==0 ){
            $getfromM->insertMessage($_POST['u_id'], $_POST['msg'], null, $_POST['t_id']);
    }else if (empty($_POST['msg']) and $_FILES['msg-upload']['size'] !=0 ){

        if ($getfromM->uploadeMsgImage($_FILES['msg-upload'])!== false) {
            $pathroot = $getfromT->uploadeTweetImage($_FILES['msg-upload']);
            $getfromM->insertMessage($_POST['u_id'], null, $pathroot, $_POST['t_id']);
        }
    }else if (!empty($_POST['msg']) and $_FILES['msg-upload']['size'] !=0 ){
        if ($getfromM->uploadeMsgImage($_FILES['msg-upload'])!== false) {
            $pathroot = $getfromT->uploadeTweetImage($_FILES['msg-upload']);
            $getfromM->insertMessage($_POST['u_id'], $_POST['msg'], $pathroot, $_POST['t_id']);
        }
    }
}