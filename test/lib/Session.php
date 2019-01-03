<?php
class Session{
    static $USER_SESSION = 'user_id';
    public static function exists($name){
        return isset($_SESSION[$name]);
    }

    public static function set($name,$value){
        $_SESSION[$name] = $value;
	}
	public static function get($name){
            if (isset($_SESSION[$name])){
                return $_SESSION[$name];
            }
            else false;
	}
	public static function delete($name){
            if(isset($_SESSION[$name])){
                unset($_SESSION[$name]);
                return true;
            }
	}
	public static function flush($name,$message=''){
            if (isset($_SESSION[$name])) {
			
            }
	}
}