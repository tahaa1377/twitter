<h4>People</h4>
<div class="message-recent">
<?foreach ($records as $record){?>
    <div class="people-message" data-id="<?=$record->user_id?>">
        <div class="people-inner">
            <div class="people-img">
                <img src="http://localhost/twitter/<?=$record->profileImage?>" alt=""/>
            </div>
            <div class="name-right">
                <span><a><?=$record->screenName?></a></span><span>@<?=$record->username?></span>
            </div>
        </div>
    </div>
<?}?>
</div>