<?php

class Input {
    public static function exists($value, $type='ALL'){
        switch ($type){
            case 'POST':
                return (isset($_POST[$value])) ? true : false ;
                break;
            case 'GET':
                return (isset($_GET[$value])) ? true : false ;
                break;
            case 'FILES':
                return (isset($_FILES[$value])) ? true :false;
            case 'ALL':
                return (isset($_POST[$value]) || isset($_GET[$value]) || isset($_FILES[$value]));
            default:
                return false;
                break;
        }
        return false;
    }
    public static function get($value, $type='ALL',$value2='name'){
        switch ($type){
            case 'POST':
                if (self::exists($value,'POST')) {
                    /* @var $_POST type */
                    return $_POST[$value];
                }
                return "";
                break;
            case 'GET':
                if (self::exists($value,'GET')) {
                    return $_GET[$value];
                }
                return "";
                break;
            case 'FILES':
                if (self::exists($value,'FILES')) {
                    return isset($_FILES[$value][$value2]) ? $_FILES[$value][$value2] : 'file not found';
                }
                return '';
                break;
            case 'ALL':
                if (self::exists($value,'POST')) {
                    return $_POST[$value];
                }
                elseif (self::exists($value,'GET')) {
                    return $_GET[$value];
                }
                elseif (self::exists($value,'FILES')) {
                    return isset($_FILES[$value][$value2]) ? $_FILES[$value][$value2] : 'file not found';
                }
                else{
                    return "";
                }
            default:
                return "";
        }
    }
    public static function remove($value, $type='POST'){
        switch ($type){
            case 'POST':
                unset($_POST[$value]);
                return true;
                break;
            case 'GET':
                unset($_GET[$value]);
                return true;
                break;
            case 'FILES':
                unset($_FILES[$value]);
                return true;
            default:
                return false;
                break;
        }
    }
}
