<?php
/**
 * Created by PhpStorm.
 * user-model: ADONIAS
 * Date: 11/21/2018
 * Time: 11:30 AM
 */

$dotenv = new Dotenv\Dotenv("../");
$dotenv->load();

define('BR','</br>');
define('ROOT_DIR' , str_replace("\\","/",dirname(__DIR__,1)));
define('PUBLIC_DIR' , ROOT_DIR . "/public_html/");
define('IMAGES_DIR' , ROOT_DIR . "/public_html/images/");
define('PROJECT_IMAGES_DIR' , IMAGES_DIR . "/projects/");
define('DB_NAME',getenv('DB_NAME'));
define('DB_URL',getenv('DB_URL'));
define('DB_USER',getenv('DB_USER'));
define('DB_PASSWORD',getenv('DB_PASSWORD'));
