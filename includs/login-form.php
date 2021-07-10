<?
if (isset($_POST['login']) && !empty($_POST['login'])){

    $email=$_POST['email'];
    $pass=$_POST['password'];

    if (!empty($email) or !empty($pass)){

        if ($getfromU->login($email,$pass) === false){
            $erore='invalid password or email';
        }else{
            header("Location: http://localhost/twitter/home");
        }

    }else{
       $erore="enter email and password!";
    }


}


?>
<div class="login-div">
<form method="post"> 
	<ul>
		<li>
		  <input type="text" name="email" placeholder="Email"/>
		</li>
		<li>
		  <input type="password" name="password" placeholder="password"/>
            <input type="submit" name="login" value="log in">
		</li>

	</ul>
    <? if (!empty($erore)){
            echo
            '<ul><li 
            class="error-li">
            <div class="span-fp-error">'.$erore.'</div>
            </li></ul>';
    }?>

	</form>
</div>