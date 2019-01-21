<?php
require_once('../../../config/init.php');

$errors = array();
$info = array();
if(Input::get("id","GET")){
    $project_id = Input::get("id","GET");
}
$projectController = ProjectController::getInstance();
$project = $projectController->getProject($project_id, false);
if(count($project) < 0 ) //redirect
if (Input::get("updateProject")){
    $newData = Helper::filterDirtyFields($project);
    $validation = new Validation();
    $validationRules  =  array(
        'name'  => array('min'=>2,'max'=>32,'unique'=>'projects'),
        'image'=>array('max_size'=>2097152,'file_type'=>array("jpg","jpeg","png","bmp"))
    );
    $validation->validate($newData,$validationRules);
    if($validation->passed && $projectController->updateProject($project_id, $newData)){
        array_push($info, "Project Updated Successfully");
        $project = $projectController->getProject($project_id);
    }
    else{
        foreach ($validation->errors as $validationError){
            array_push($errors, $validationError);
        }
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

    <link rel="stylesheet" href="../../css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

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
                    <li class="menu-item"><a href="../index.php">Projects</a></li>
                    <li class="menu-item"><a href="../user/index.php">Users</a></li>
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
                            <?php if(count($errors) > 0):?>
                                <?php foreach ($errors as $error): ?>
                                    <div class="form-error"><?=$error?></div>
                                <?php endforeach;?>
                            <?php elseif (count($info) > 0):?>
                                <?php foreach ($info as $i): ?>
                                    <div class="form-success"><?=$i?></div>
                                <?php endforeach;?>
                            <?php endif;?>
                            <form method="post" action="#" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=$project['id']?>">
                                <p>Project Name</p>
                                    <input type="text"  name="name" value="<?=$project['name']?>"><br>
                                <p>Project Type</p>
                                    <input type="text"  name="type" value="<?=$project['type']?>"><br>
                                <p>Client</p>
                                    <input type="text"  name="client" value="<?=$project['client']?>"><br>
                                <p>Price</p>
                                    <input type="text"  name="price" value="<?=$project['price']?>"><br>
                                <p>Image</p>
                                    <input type="file"  name="image"><br>
                                <p>Description</p>
                                <textarea name="description" id="" cols="30" rows="10" placeholder="project description ..."><?=$project['description']?></textarea><br>
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
<script src="../../js/bootstrap-toggle.min.js"></script>
</body>
</html>