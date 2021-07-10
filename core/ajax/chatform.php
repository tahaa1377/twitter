<?require_once '../init.php';
$data=$getfromU->userData($_SESSION['user_id']);
?>

<!-- MESSAGE CHAT START -->
<div class="popup-message-body-wrap">
    <input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
    <input id="message-body" type="checkbox" checked="unchecked"/>
    <div class="wrap3">
        <div class="message-send2">
            <div class="message-header2">
                <div class="message-h-left">
                    <label class="back-messages" for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
                </div>
                <div class="message-h-cen">
                    <div class="message-head-img">
                        <h4>Messages</h4>
                    </div>
                </div>
                <div class="message-h-right">
                    <label class="close-msgPopup" for="message-body" ><i class="fa fa-times" aria-hidden="true"></i></label>
                </div>
                <div class="message-del">
                    <div class="message-del-inner">
                        <h4>Are you sure you want to delete this message? </h4>
                        <div class="message-del-box">
					<span>
						<button class="cancel" value="Cancel">Cancel</button>
					</span>
                            <span>
						<button class="delete" value="Delete">Delete</button>
					</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-msg-wrap">
                <div id="chat" class="main-msg-inner">

                </div>
            </div>
            <div class="main-msg-footer">
                <div class="main-msg-footer-inner">
                    <form id="messageForm" method="post" enctype="multipart/form-data">
                    <ul>
                        <li><textarea style="width: 100%;height: 30px" id="msg" name="msg" "></textarea></li>
                        <li><input name="msg-upload" id="msg-upload1" type="file" value="upload"/><label for="msg-upload1"><i class="fa fa-camera" aria-hidden="true"></i></label></li>
                        <li><input type="hidden" name="u_id" value="<?=$data->user_id?>"></li>
                       <li><input type="hidden" name="t_id" value="<?=$QQ?>"></li>
<!--                        <li><input data-id="--><?//=$data->user_id?><!--" data-taraf="--><?//=$QQ?><!--" id="send" type="submit" value="Send"/></li>-->
                        <li><input id="send" type="submit" value="Send"/></li>
                    </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

