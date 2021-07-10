<div class="nav-right-down-wrap">
    <ul>
        <? foreach ($records as $record){ ?>
        <li><a href="http://localhost/twitter/profile.php?username=<?=$record->username?>">
            <div class="nav-right-down-inner">
                <div class="nav-right-down-left">
                    <a href="http://localhost/twitter/profile.php?username=<?=$record->username?>"><img src="http://localhost/twitter/<?=$record->profileImage?>"></a>
                </div>
                <div class="nav-right-down-right">
                    <div class="nav-right-down-right-headline">
                        <span><?="$record->screenName"?></span><br>
                        <a href="http://localhost/twitter/profile.php?username=<?=$record->username?>">@<?="$record->username"?></a>
                    </div>
                    <div class="nav-right-down-right-body">

                    </div>
                </div>
            </div>
            </a>
        </li>
<?}?>
    </ul>
</div>