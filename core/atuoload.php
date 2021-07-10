<?
function __autoload($classname) {

    if (strpos($classname, 'User') !== false) {
        require_once ('classes/user.php');
        return;
    }

    if (strpos($classname, 'Follow') !== false) {
        require_once ('classes/follow.php');
        return;
    }

    if (strpos($classname, 'Twitte') !== false) {
        require_once ('classes/twitte.php');
        return;
    }

}