<?php
/**
 * Created by PhpStorm.
 * User: ADONIAS
 * Date: 12/3/2018
 * Time: 12:15 PM
 */
require_once('../../config/init.php');

if(!Session::exists('user_id') && false){
    header("Location: ../users/signin.php?redirected-from=../projects/viewProjects.php&message=Please+signin+first");
}
$Project_manager = ProjectController::getInstance();
$projects = $Project_manager->getProjects(false);
//handle ajax request
if(Input::get("action", "GET") == "update-status"){
    $projectId = Input::get("id", "GET");
    $enabled = Input::get("enabled", "GET");
    $projectController = ProjectController::getInstance();
    $success = $projectController->disableProject($projectId , $enabled);
    echo($success);
}
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

    <title>Archi Design | Admin</title>

    <!-- Loading third party stylesheets -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-toggle.min.css">

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
            <a href="../index.html" id="branding">
                <img src="../images/logo.png" alt="" class="logo">
                <div class="logo-text">
                    <h1 class="site-title">ADMIN</h1>
                    <small class="site-description"></small>
                </div>
            </a> <!-- #branding -->

            <div class="main-navigation">
                <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
                <ul class="menu">
                    <li class="menu-item current-menu-item"><a href="#">Projects</a></li>
                    <li class="menu-item"><a href="users.php">Users</a></li>
                </ul> <!-- .menu -->
            </div> <!-- .main-navigation -->
            <div class="mobile-navigation"></div>
        </div>
    </div> <!-- .site-header -->

    <main class="main-content">
        <div class="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-title">Manage Projects</h2>
                        <div class="container">
                            <?php if ($projects && count($projects) > 0): ?>
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($projects as $project):?>
                                        <a href="">
                                            <tr scope="row">
                                                <th><?=$project["id"]?></th>
                                                <td><?=$project["name"]?></td>
                                                <td><?=$project["client"]?></td>
                                                <td><?=$project["price"]?></td>
                                                <td><?=substr($project["description"],0,30)?>...</td>
                                                <td><a class="button-small" href="project/updateProject.php?id=<?=$project["id"]?>">Edit</a></td>
                                                <td><input id="<?=$project["id"]?>" data-toggle="toggle" class="toggle-project-state"
                                                           type="checkbox" data-size="small" data-onstyle="success" data-offstyle="danger"
                                                        <?=$project['enabled']?"checked":""?>  data-on="Enabled" data-off="Disabled">
                                                </td>
                                            </tr>
                                        </a>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>

                            <?php else:?>
                                <h1>No Projects Here!</h1>
                            <?php endif;?>
                            <a href="project/addProject.php" class="button">Add Project</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .page -->

    </main> <!-- .main-content -->

</div>

<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/plugins.js"></script>
<script src="../js/app.js"></script>
<script src="../js/bootstrap-toggle.min.js"></script>
</body>
</html>