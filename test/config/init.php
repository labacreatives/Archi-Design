<?php
session_start();
require '../vendor/autoload.php';
require_once ("config.php");

spl_autoload_register(function($file_name){
    $dirs_to_scan = array(
        ROOT_DIR."/cms/controllers",
        ROOT_DIR."/cms/models",
        ROOT_DIR."/lib"
    );
    foreach ($dirs_to_scan as $dir){
        foreach (scandir($dir) as $file){
            if($file_name.".php" == $file && file_exists($dir.'/'.$file)){
                include ($dir.'/'.$file);
                break 2;
            }
        }
    }
});
