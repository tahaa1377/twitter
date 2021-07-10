<?
require_once ('core/init.php');
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    header('Location: http://localhost/twitter/home');
}
?>
<html>
<head>
    <title>twitter</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css?k"/>
    <link rel="stylesheet" href="http://localhost/twitter/assets/css/style-complete.css?ino3se"/>
</head>

<div class="front-img">
    <img src="http://localhost/twitter/assets/images/background.jpg">
</div>

<div class="wrapper">

    <div class="header-wrapper">



    </div>

    <div class="inner-wrapper">

        <div class="main-container">

            <div class="content-left">

            </div>


            <div class="content-right">

                <div class="login-wrapper">
                    <?require_once ('includs/login-form.php');?>
                </div>

                <div class="signup-wrapper">
                    <?require_once ('includs/signup-form.php');?>

                </div>


            </div>

        </div>

    </div>
</div>
</body>
</html>
