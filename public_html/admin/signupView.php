<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/e-commerce/inc/init.php');
require_once ('../CMS/Input.php');
require_once ('../CMS/user-controller.php');
require_once ('../CMS/Hash.php');
require_once('../CMS/Validation.php');
require_once ('../CMS/user-model.php');

$_POST['name'] = "";
$_POST['email'] = "john1@gmail.com";
$_POST['password'] = "123456";
$_POST['re_password'] = "123456";
$_POST['signup'] = true;

if(Input::exists("signup")){
    $validation = new Validation();
    $data_to_validate = array(
        'name'=> array('required'=>true,'min'=>2,'max'=>16),
        'email'=> array('required'=>true, 'email'=> true,'min'=>9,'unique'=>'users'),
        'password'=> array('required'=>true,'match'=>'re_password','min'=>6,'max'=>16)
    );
    $validation->validateInput($data_to_validate);
    if($validation->passed){
        $user_manager = UserController::getInstance();
        $new_user = new User(Input::get("name"), Input::get("email"), Input::get("password"));
        $new_user->setSalt(Hash::generateSalt(32));
        $hashed_password = Hash::generateHash(Input::get('password').$new_user->getsalt());
        $new_user->setPassword($hashed_password);
        
        if($user_manager->addUser($new_user)){
            //Email the user Here for validation purposes
        }
        else{
            echo 'FAIL!\n';
        }
    }
    else {
       $validation->printErrors();
    }
}
?>
<!DOCTYPE>
<html>
<head>

</head>
<body>
    <form method="post" action="#">
        <input type="text"  name="name" placeholder="Your-Name" required="true"><br>
        <input type="email" name="email" placeholder="Your-Email" required="true"><br>
        <input type="text"  name="password" placeholder="Password" required="true"><br>
        <input type="text"  name="re_password" placeholder="confirm Password" required="true"><br>
        <input type="submit" name="signup" value="signup">
    </form>
</body>
</html>