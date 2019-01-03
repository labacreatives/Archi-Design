<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/e-commerce/inc/init.php');
require_once ('../CMS/Input.php');
require_once ('../CMS/user-controller.php');
require_once ('../CMS/Validation.php');
require_once ('../CMS/user-model.php');
require_once ('../CMS/Session.php');

$_POST['email'] = "john1@gmail.com";
$_POST['password'] = "123456";
$_POST['signin'] = true;
$_GET['redirected-from'] = "/Laba_Projects/archi_design_website/www/projects.php";
if(Input::exists('redirected-from', "GET")){
    $redirectedFrom = Input::get("redirected-from","GET");
}
if(Input::exists('message', "GET")){
    $redirectMessage = Input::get("message","GET");
}
echo $redirectedFrom;

if(Input::exists("signin")){
    unset($redirectMessage);
    $validation = new Validation();
    $data_to_validate = array(
        'email'=>array('required'=>true),
        'password'=>array('required'=>true)
    );
    $validation->validate($data_to_validate);
    if($validation->passed){
        $user = new User();
        $user->setEmail(Input::get('email'));
        $user->setPassword(Input::get('password'));
        
        $user_manager = UserController::getInstance();
        $login_success = $user_manager->login($user);
        if($login_success){
            Session::set("user_id",  UserController::getCurrentUser()->getID());
            if(Input::exists('redirected-from','GET')){
                echo "redirected";
                header('Location:'.$redirectedFrom);
            }
            else{
                header("Location:projects.php");
            }
        }
        Session::set("signin-errors", "Invalid Credentials");
    }
    else {
        Session::set("signin-errors", "Failed to Signin");
    }
    Session::set('signin-errors',is_array(Session::get('signin-errors')) ?
        Session::get('signin-errors') : array(Session::get('signin-errors')));
}
?>


<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

    <title>Modern Architecture | Contact</title>

    <!-- Loading third party fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400|" rel="stylesheet" type="text/css">
    <link href="../fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Loading main css file -->
    <link rel="stylesheet" href="../style.css">

    <!--[if lt IE 9]>
    <script src="../js/ie-support/html5.js"></script>
    <script src="../js/ie-support/respond.js"></script>
    <![endif]-->
</head>
<body>

<div id="site-content">
    <div class="site-header">
        <div class="container">
            <a href="index.html" id="branding">
                <img src="../images/logo.png" alt="" class="logo">
                <div class="logo-text">
                    <h1 class="site-title">ARCHI DESIGN</h1>
                    <small class="site-description"></small>
                </div>
            </a> <!-- #branding -->

            <div class="mobile-navigation"></div>
        </div>
    </div> <!-- .site-header -->

    <main class="main-content">
        <div class="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-form">
                            <h2 class="section-title">Sign In</h2>
                            <?php if(Session::exists("signin-errors") && count(Session::get("signin-errors"))) :?>
                                <?php foreach (Session::get("signin-errors") as $error): ?>
                                    <div class="form-error"><?=$error?></div>
                                <?php endforeach;?>
                            <?php elseif(Session::get('signin-success')):?>
                                <div class="form-success"><?=Session::get('form-success')?></div>
                            <?php endif;?>
                            <?php if(isset($redirectMessage) && !empty($redirectMessage)):?>
                                <div class="form-info"><?=$redirectMessage?></div>
                            <?php endif;?>
                            <form method="post" action="#">
                                <input type="email" name="email" placeholder="Email" value=<?= Input::get('email')?>>
                                <input type="password" name="password" placeholder="Password">
                                <input type="submit" name="signin" value="Sign In"">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .page -->

    </main> <!-- .main-content -->

</div>

<script src="../js/jquery-1.11.1.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script src="../js/plugins.js"></script>
<script src="../js/app.js"></script>

</body>
</html>