<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/e-commerce/inc/init.php');
class UserController {
    private static $_instance,$current_user;
    private $database;
   
    private function __construct() {
        $this->database = Database::getInstance();
    }
    private function userExists($column,$value){
        $result = $this->database->select('users',array($column),"WHERE {$column}='{$value}';");
        if($result && count($result)== 1){
            return true;
        }
        return false;
    }
    
    static function getInstance(){
         if (!isset(self::$_instance)){
             self::$_instance = new UserController;
         }
         return self::$_instance;
     }  
    static function  getCurrentUser(){
        return self::$current_user;
    }
    static function removeCurrentUser(){
        self::$current_user = NULL;
    }
    static function currentUserExists(){
        return isset(self::$current_user) && Session::exists('user_id');
    }
    function getUserByEmail($email){
        $result = $this->database->select('users',array('*'),"WHERE email = '{$email}' AND enabled = true;");
        if(count($result)==1){
            $found_user = $result[0];
            $user = new User();
            $user->setId($found_user['id']);
            $user->setName($found_user['name']);
            $user->setEmail($found_user['email']);
            $user->setPassword($found_user['password']);
            $user->setSalt($found_user['salt']);
            $user->setLastLogin($found_user['last_login']);
            $user->setCreatedAt($found_user['created_at']);
            $user->setUpdatedAt($found_user['updated_at']);
            return $user;
        }
        return false;
    }

    function getUserById($user_id){
        $result = $this->database->select('users',array('*'),"WHERE user_id = '{$user_id}'");
        if(count($result)==1){
            $found_user = $result[0];
            $user = new User();
            return $user;
        }
        return false;
    }

    function addUser(User $new_user){
        return $this->database->insert('users',array('name','email','password',"salt"),
            array(
                $new_user->getName(),
                $new_user->getEmail(),
                $new_user->getPassword(),
                $new_user->getSalt(),
            )
        );
    }

    function login(User $user_data){
       $email = $user_data->getEmail();
       $password = $user_data->getPassword();
       $userInDatabase = $this->getUserByEmail($user_data->getEmail());
       if($userInDatabase){
           if($userInDatabase->getEmail() == $user_data->getEmail()){
               $password = Hash::generateHash($user_data->getPassword() . $userInDatabase->getsalt());
               if($password == $userInDatabase->getPassword()){
                   self::$current_user = $userInDatabase;
                   self::$current_user->getName();
                   return true;
                }//else echo "wrong password";   
            }//else echo "email not found";  
        }
        return false;
     }
}
