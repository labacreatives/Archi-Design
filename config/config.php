<?php
/**
 * Created by PhpStorm.
 * user-model: ADONIAS
 * Date: 11/21/2018
 * Time: 11:30 AM
 */

define('ROOT_DIR' , str_replace("\\","/",dirname(__DIR__,1)));

//Import all environment variables from .env file
require_once (ROOT_DIR."/vendor/autoload.php");
//todo put a safe guard for when .env file doesn't exist
$dotenv = new Dotenv\Dotenv(ROOT_DIR);
$dotenv->load();

define('BR','</br>');
define('PUBLIC_DIR' , ROOT_DIR . "/public_html/");
define('IMAGES_DIR' , ROOT_DIR . "/public_html/images/");
define('PROJECT_IMAGES_DIR' , IMAGES_DIR . "projects/");
define('DB_NAME',getenv('DB_NAME'));
define('DB_URL',getenv('DB_URL'));
define('DB_USER',getenv('DB_USER'));
define('DB_PASSWORD',getenv('DB_PASSWORD'));

