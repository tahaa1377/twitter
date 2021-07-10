<?
require_once ('../init.php');
if (isset($_POST['hashtag'])){
  $hastag = $_POST['hashtag'];
  $mention = $_POST['hashtag'];
  if (substr($hastag,0,1)==='#'){
      $hastag=str_replace("#","",$hastag);
      $ta=$getfromT->getTrendsByHashtag($hastag);
      require_once ('../ajax/hashTagForm.php');
  }else  if (substr($mention,0,1)==='@'){
      $mention=str_replace("@","",$mention);
      $ta=$getfromT->getTendsByMention($mention);
      require_once ('../ajax/mentionForm.php');
  }
}

