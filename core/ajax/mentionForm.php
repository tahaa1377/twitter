<?foreach ($ta as $t){?>
<li><div class="nav-right-down-inner">
        <div class="nav-right-down-left">
            <span><img src="<?=$t->profileImage?>" alt=""></span>
        </div>
        <div class="nav-right-down-right">
            <div class="nav-right-down-right-headline">
                <a href="http://localhost/twitter/profile.php?username=<?=$t->username?>"><?=$t->screenName?></a><span class="getValue">@<?=$t->username?></span>
            </div>
        </div>
    </div>
</li>
<?}?>