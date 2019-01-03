<?php
/**
 * Created by PhpStorm.
 * User: ADONIAS
 * Date: 11/22/2018
 * Time: 1:31 PM
 */

require_once ('../CMS/Input.php');
require_once ('../CMS/project-controller.php');
require_once('../CMS/Validation.php');
require_once ('../CMS/Session.php');


if(!Session::exists('user_id'))
    header("Location:signinView.php?redirected-from={$_SERVER['SCRIPT_NAME']}&message=Please+signin+first");

$Project_manager = ProjectController::getInstance();
$Projects = $Project_manager->getAllProjects();

?>
<?php if($Projects):?>

    <?php foreach ($Projects as $Project): ?>
        <aside>
<!--            <a href='updateProject.php?id=--><?//=$Project['id']?><!--'><img src="--><?//=IMAGE_DIR."/".$Project['image_path']?><!--"></a>-->
            <div>
<!--                <span>by --><?//=$current_user->getFirstName()?><!--</span>-->
<!--                <h3><a href='updateProject.php?id=--><?//=$Project['id']?><!--'>--><?//=$Project['Project_name']?><!--</a></h3>-->
                <ul><li><?=$Project['description']?></li></ul>
                <aside>
                    <p><?=$Project['name']?></p>
                    <a href='#'>Price: <?=$Project['price']?> ETB</a><br>
                </aside>
            </div>
        </aside>
    <?php endforeach;?>
<?php endif;?>