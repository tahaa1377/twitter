<?
if (isset($_POST['signup'])){

    $fullname=$_POST['screenName'];
    $email=$_POST['email'];
    $password=$_POST['password'];

   if (empty($fullname) || empty($email) || empty($password)){
       $error='all feiled must full';
   }else{

       if (strlen($fullname) > 20){
           $error='fullname is too large';
       }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
           $error='email format is wrong';
       }else if (strlen($password)<5){
           $error="password is too short";
       }else{


           if ($getfromU->cheakemail($email) === false){
               $error='you are registered';
           }else{
               $getfromU->register($fullname,$email,$password);
               header('Location: http://localhost/twitter/username1');
           }
       }

   }


}
?>
<form method="post">
<div class="signup-div"> 
	<h3>Sign up </h3>
	<ul>
		<li>
		    <input type="text" name="screenName" placeholder="Full Name"/>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email"/>
		</li>
		<li>
			<input type="password" name="password" placeholder="Password"/>
		</li>
		<li>
			<input type="submit" name="signup" Value="Signup for Twitter">
		</li>
	</ul>
    <?
    if (!empty($error)){
        echo '<ul>
	 <li class="error-li">
	  <div class="span-fp-error">'.$error.'</div>
	 </li> 
	 </ul>';
    }
    ?>
</div>
</form>