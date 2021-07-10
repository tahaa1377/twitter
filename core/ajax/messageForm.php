<?require_once '../init.php'?>
<div class="popup-message-wrap">
    <input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
    <div class="wrap2">
        <div class="message-send">
            <div class="message-header">
                <div class="message-h-left">
                    <label for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
                </div>
                <div class="message-h-cen">
                    <h4>New message</h4>
                </div>
                <div class="message-h-right">
                    <label for="popup-message-tweet" ><i class="fa fa-times" aria-hidden="true"></i></label>
                </div>
            </div>
            <div class="message-input">
                <h4>Send message to:</h4>
                <input type="text" placeholder="Search people" class="search-user"/>
                <ul class="search-result down">

                </ul>
            </div>
            <div class="message-body">
                <h4>Recent</h4>
                <div class="message-recent">
                    <!--Direct Messages-->
                    <?foreach ($mess as $m){?>
                    <div  class="people-message" data-id="<?=$m->user_id?>">
                        <div class="people-inner">
                            <div class="people-img">
                                <img src="http://localhost/twitter/<?=$m->profileImage?>"/>
                            </div>
                            <div class="name-right2">
                                <span><a href="#"><?=$m->screenName?></a></span><span>@<?=$m->username?></span>
                            </div>

                            <span>
						<?=$getfromT->timeAgo($m->messageOn)?>
					</span>
                        </div>
                    </div>
                    <?}?>
                    <!--Direct Messages-->
                </div>
            </div>
            <!--message FOOTER-->
            <div class="message-footer">
                <div class="ms-fo-right">
                    <label>Next</label>
                </div>
            </div><!-- message FOOTER END-->
        </div><!-- MESSGAE send ENDS-->


        <input id="mass" type="checkbox" checked="unchecked" />
        <div class="back">
            <div class="back-header">
                <div class="back-left">
                    Direct message
                </div>
                <div class="back-right">
                    <label for="mass"  class="new-message-btn">New messages</label>
                    <label for="popup-message-tweet"><i class="fa fa-times" aria-hidden="true"></i></label>
                </div>
            </div>
            <div class="back-inner">
                <div class="back-body">
                    <!--Direct Messages-->
                    <?foreach ($mess as $m){?>
                    <div class="people-message" data-id="<?=$m->user_id?>">
                        <div class="people-inner">
                            <div class="people-img">
                                <img src="http://localhost/twitter/<?=$m->profileImage?>"/>
                            </div>
                            <div class="name-right2">
                                <span><a href="#"><?=$m->screenName?></a></span><span>@<?=$m->username?></span>
                            </div>
                            <div class="msg-box">
                                <?=$m->message?>
                            </div>

                            <span>
								<?=$getfromT->timeAgo($m->messageOn)?>
						</span>
                        </div>
                    </div>
                    <!--Direct Messages-->
                    <?}?>
                </div>
            </div>
            <div class="back-footer">

            </div>
        </div>
    </div>
</div>
<!-- POPUP MESSAGES END HERE -->
