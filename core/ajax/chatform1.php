<?require_once '../init.php';
foreach ($chats as $chat){
    if ($chat->messageFrom == $_SESSION['user_id']){?>
        <div class="main-msg-body-right">
            <div class="main-msg">
                <div class="msg-img">
                    <a href="#"><img src="http://localhost/twitter/<?=$chat->profileImage?>" alt=""/></a>
                </div>
                <div class="msg">
                    <?if($chat->message != null){?>
                        <?=$chat->message?>
                   <? }
                    ?>
                    <?if($chat->messageImage != null){?>
                        <img src="http://localhost/twitter/<?=$chat->messageImage?>" style="width: 100px;height: 100px">
                    <? } ?>

                    <div class="msg-time">
                        <?=$getfromT->timeAgo($chat->messageOn)?>
                    </div>
                </div>
                <div class="msg-btn">
                    <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                    <a class="deleteMsg" data-id="<?=$chat->user_id?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <!--Main message BODY RIGHT END-->
    <?}else{?>
        <!--Main message BODY LEFT START-->
        <div class="main-msg-body-left">
            <div class="main-msg-l">
                <div class="msg-img-l">
                    <a href="#"><img src="http://localhost/twitter/<?=$chat->profileImage?>" alt=""/></a>
                </div>
                <div class="msg-l"><?=$chat->message?>
                    <div class="msg-time-l">
                        <?=$getfromT->timeAgo($chat->messageOn)?>
                    </div>
                </div>
                <div class="msg-btn-l">
                    <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                    <a class="deleteMsg" data-id="<?=$chat->user_id?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    <?}
}?>
