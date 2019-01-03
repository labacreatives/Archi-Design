<?php
class Hash {
    public static function generateHash($string){
        return hash("sha256", $string);
    }
    public static function generateSalt($length){
        return random_bytes($length);
    }
}
