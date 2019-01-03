<?php
/**
 * Created by PhpStorm.
 * User: ADONIAS
 * Date: 1/1/2019
 * Time: 1:24 PM
 * file.php?action="update-status",id=1&state=1
 */
//$_GET["action"] = "update-status" ;
//$_GET["state"]  = 1 ;
//$_GET["id"]     = 1 ;
//

require_once ("../../config/init.php");
if(Input::get("action", "GET") == "update-status"){
    $projectId = Input::get("id", "GET");
    $enabled = Input::get("enabled", "GET");
    $projectController = ProjectController::getInstance();
    $success = $projectController->disableProject($projectId , $enabled);
    echo($success);
}
$validation = new Validation();
$data_to_validate  =  array(
    'name'  => array('required'=>true,'min'=>2,'max'=>32,'unique'=>'projects'),
    'image'=>array('max_size'=>2097152,'file_type'=>array("jpg","jpeg","png","bmp"))
);

$validation->validate($data_to_validate);
if(Input::exists("id")){
    $fieldsToUpdate = array();
    $dataToUpdate = array();
    if(Input::exists("name")){
        array_push($fieldsToUpdate,"name");
        array_push($dataToUpdate,Input::get("name"));
    }
    if(Input::exists("type")){
        array_push($fieldsToUpdate,"type");
        array_push($dataToUpdate,Input::get("type"));
    }
    if(Input::exists("price")){
        array_push($fieldsToUpdate,"price");
        array_push($dataToUpdate, Input::get("price"));
    }
    if(Input::exists("client")){
        array_push($fieldsToUpdate,"client");
        array_push($dataToUpdate, Input::get("client"));
    }
    if(Input::exists("image")){
        array_push($fieldsToUpdate,"image");
        array_push($dataToUpdate, Input::get("image"));
    }
    if(Input::exists("description")){
        array_push($fieldsToUpdate,"description");
        array_push($dataToUpdate, Input::get("description"));
    }

    $projectController->updateProject($id, $fieldsToUpdate, $dataToUpdate);
}else{

}