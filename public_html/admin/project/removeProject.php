<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/e-commerce/inc/init.php');
require_once('../../CMS/Input.php');
require_once('../../CMS/project-controller.php');
require_once('../../CMS/Validation.php');
require_once('../../CMS/project-model.php');

//$_POST['name'] = "AYAT real estate";
//$_POST['description'] = "A 5 story 400msq apartment building";
//$_POST['image_path'] = "image";
//$_POST['type'] = "Real estate";
//$_POST['client'] = "AYAT";
//$_POST['price'] = "1500000";
//
//$_POST['updateProject'] = true;
if(Input::get("id","GET")){
    $project_id = Input::get("id","GET");
}
else{
    header("Location: ./project_management.php");
}
if(Input::exists("updateProject")){
    $validation = new Validation();
    $data_to_validate  =  array(
        'name' => array('required'=>true,'min'=>2,'max'=>32,'unique'=>'projects'),
        'image'=>array('max_size'=>2097152,'file_type'=>array("jpg","jpeg","png","bmp"))
    );
    $validation->validateInput($data_to_validate);
    if($validation->passed){
        $project_manager = ProjectController::getInstance();
        $project = new Project(
            Input::get('description'),
            Input::get('image_path' ),
            Input::get('type'       ),
            Input::get('client'     ),
            Input::get('price'      )
        );
        if($project_manager->updateProject($project)){
            //Email the user Here for validation purposes
        }
        else{
            echo 'FAIL!\n';
        }
    }
    else {
        Session::set("form-errors",$validation->errors);
    }
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
    <link href="../../fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Loading main css file -->
    <link rel="stylesheet" href="../../style.css">

    <!--[if lt IE 9]>
    <script src="../../js/ie-support/html5.js"></script>
    <script src="../../js/ie-support/respond.js"></script>
    <![endif]-->
</head>
<body>

<div id="site-content">
    <div class="site-header">
        <div class="container">
            <a href="../index.html" id="branding">
                <img src="../../images/logo.png" alt="" class="logo">
                <div class="logo-text">
                    <h1 class="site-title">ARCHI DESIGN</h1>
                    <small class="site-description"></small>
                </div>
            </a> <!-- #branding -->

            <!-- Default snippet for navigation -->
            <div class="main-navigation">
                <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
                <ul class="menu">
                    <li class="menu-item"><a href="../index.html">Home</a></li>
                    <li class="menu-item"><a href="../ourProjects.php">our Projects</a></li>
                    <li class="menu-item"><a href="../about.html">About</a></li>
                    <li class="menu-item current-menu-item"><a href="../contact.html">Contact</a></li>
                </ul> <!-- .menu -->
            </div> <!-- .main-navigation -->

            <div class="mobile-navigation"></div>
        </div>
    </div> <!-- .site-header -->
    <main class="main-content">
        <div class="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-form">
                            <h2 class="section-title">Update Project</h2>
                            <form method="post" action="#">
                                <input type="text"  name="name" placeholder="project name ..." required="true"><br>
                                <input type="text"  name="type" placeholder="project type ..." required="true"><br>
                                <input type="text"  name="client" placeholder="client ..." required="true"><br>
                                <input type="text"  name="price" placeholder="price ..." required="true"><br>
                                <input type="file"  name="image"><br>
                                <textarea name="description" id="" cols="30" rows="10" placeholder="project description ..."></textarea><br>
                                <input type="submit" name="updateProject" value="update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .page -->
    </main> <!-- .main-content -->

</div>

<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script src="../../js/plugins.js"></script>
<script src="../../js/app.js"></script>
</body>
</html>