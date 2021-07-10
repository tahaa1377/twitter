<?require_once '../init.php';

if (isset($_POST['tweetId']) && !empty($_POST['tweetId'])){
    $id=$_POST['tweetId'];
    $record=$getfromT->getPopuptweet($id);
    require_once 'imagePopupform.php';
}