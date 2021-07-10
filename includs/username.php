<?
require_once ('../core/init.php');

$user_id=$_SESSION['user_id'];

$data=$getfromU->userData($user_id);

if (isset($_POST['next']) && !empty($_POST['next'])){

    if ($_REQUEST['step'] == '1'){

        if (!empty($_POST['username'])){

            if (strlen($_POST['username'])>20){
                $error="length of username between 6-20";
            }else if ($getfromU->cheakUsername($_POST['username']) === true){
                $error="this username is exist";
            }else{
                $getfromU->addUseranem($_POST['username']);
                header("Location: http://localhost/twitter/username2");
            }

        }else{
            $error='you must choose username';
        }
    }

}



?>
<!doctype html>
<html>
<head>
    <title>twitter</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="http://localhost/twitter/assets/css/font/css/font-awesome.css"/>
    <link rel="stylesheet" href="http://localhost/twitter/assets/css/style-complete.css"/>
</head>
<!--Helvetica Neue-->
<body>
<div class="wrapper">
    <!-- nav wrapper -->
    <div class="nav-wrapper">

        <div class="nav-container">
            <div class="nav-second">
                <ul>
                    <li><a href="#"<i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                </ul>
            </div><!-- nav second ends-->
        </div><!-- nav container ends -->

    </div><!-- nav wrapper end -->

    <!---Inner wrapper-->
    <div class="inner-wrapper">
        <!-- main container -->
        <div class="main-container">
            <!-- step wrapper-->

            <?if ($_REQUEST['step'] == '1'){?>
            <div class="step-wrapper">
                <div class="step-container">
                    <form method="post">
                        <h2>Choose a Username</h2>
                        <h4>Don't worry, you can always change it later.</h4>
                        <div>
                            <input type="text" name="username" placeholder="Username"/>
                        </div>
                        <div>
                            <?if (!empty($error)){?>
                            <ul>
                                <li style="color: red"><?=$error?></li>
                            </ul>
                           <? }?>
                        </div>
                        <div>
                            <input type="submit" name="next" value="Next"/>
                        </div>
                    </form>
                </div>
            </div>
            <?}?>
            <?if ($_REQUEST['step'] == '2'){?>
           	<div class='lets-wrapper'>
                    <div class='step-letsgo'>
                        <h2>We're glad you're here, <?=$data->username?></h2>
                        <p>Tweety is a constantly updating stream of the coolest, most important news, media, sports, TV, conversations and more--all tailored just for you.</p>
                        <br/>
                        <p>
                            Tell us about all the stuff you love and we'll help you get set up.
                        </p>
                        <span>
                            <a href='http://localhost/twitter/home' class='backButton'>Let's go!</a>
                        </span>
                    </div>
                </div>
            <?}?>

        </div><!-- main container end -->

    </div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->

</body>
</html>
