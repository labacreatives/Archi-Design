<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/e-commerce/inc/init.php');
require_once('../../../config/init.php');

//$_POST['name'] = "AYAT real estate";
//$_POST['description'] = "A 5 story 400msq apartment building";
//$_POST['image'] = "C:\Users\ADONIAS!!\Desktop\\1.jpg";
//$_POST['type'] = "Real estate";
//$_POST['client'] = "AYAT";
//$_POST['price'] = "1500000";
//$_POST['createProject'] = true;

$errors = array();
$infos = array();
if(Input::exists("createProject")){
    $validation = new Validation();
    $data_to_validate  =  array(
        'name'  => array('required'=>true,'min'=>2,'max'=>32,'unique'=>'projects'),
        'image'=>array('max_size'=>2097152,'file_type'=>array("jpg","jpeg","png","bmp"))
    );
    $validation->validate($data_to_validate);
    if($validation->passed){
        //upload image
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
        $image_name = uniqid() .'.'. $imageFileType;
        $target_file = PROJECT_IMAGES_DIR . $image_name;
        $uploadSuccess = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        if(!$uploadSuccess){
            array_push($validation->errors,"Image Upload Failed");
//            Session::set("form-errors", $validation->errors);
        }
        else{
            $project_manager = ProjectController::getInstance();
            $new_project = new Project(
                Input::get('name'       ),
                Input::get('description'),
                $target_file,
                $image_name,
                Input::get('type'       ),
                Input::get('client'     ),
                Input::get('price'      )
            );
            $successCreating = $project_manager->addProject($new_project);

            if($successCreating){
                array_push($infos,"Project Added Successfully");
//                Session::set("form-success","Project Added Successfully");
            }
            else{
                array_push($errors,"Failed to Create Project");
//                Session::set("form-errors","Failed to Create Project");
            }
        }
    }
    else {
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
                            <h2 class="section-title">Add a Project</h2>
                            <?php if(count($errors) > 0):?>
                                <?php foreach ($errors as $error): ?>
                                    <div class="form-error"><?=$error?></div>
                                <?php endforeach;?>
                            <?php elseif (count($infos) > 0):?>
                                <?php foreach ($infos as $info): ?>
                                    <div class="form-success"><?=$info?></div>
                                <?php endforeach;?>
                            <?php endif;?>
                            <form method="post" action="#" enctype="multipart/form-data">
                                <input type="text"  name="name"   placeholder="project name ..." required="true" value="<?=Input::get("name")?>"><br>
                                <input type="text"  name="type"   placeholder="project type ..." value="<?=Input::get("type")?>"><br>
                                <input type="text"  name="client" placeholder="client ..." value="<?=Input::get("client")?>"><br>
                                <input type="text"  name="price"  placeholder="price ..." value="<?=Input::get("price")?>"><br>
                                <input type="file"  name="image" ><br>
                                <textarea name="description" id="" cols="30" rows="10" placeholder="project description ..." value="<?=Input::get("description")?>"></textarea><br>
                                <input class="button" type="submit" name="createProject" value="Add Project" >
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