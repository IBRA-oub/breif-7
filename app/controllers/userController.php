<?php

require_once("../models/DataProvider.php");
require_once("../models/user.php");
require_once("../models/roleOfUserModel.php");


session_start();
class UserController extends DataProvider{

    public function login ($username,$pw){
        
        $loggingUser = new Users();
        $loggingUserData = $loggingUser->getUserByUsername($username);

        var_dump($loggingUserData && password_verify($pw, $loggingUserData->pw));

        if($loggingUserData && password_verify($pw, $loggingUserData->pw)){

            $roleOfLoggingUserData = $loggingUser->getRoleByUsername($username);

            // var_dump($loggingUser->getRoleByUsername($username));


            if($roleOfLoggingUserData->roleName == "admin"){
                $_SESSION["username"] = $username;
                $_SESSION["role"] = "admin";
                redirect("../views/admin/Users.php",false);
                // header("Location: ../views/admin/Bank.php");
            }else{
                $_SESSION["username"] = $username;
                $_SESSION["role"] = "client";
                redirect("../views/client/index.php?id=" . $loggingUserData->userId,false);
            }
        
        } else{
            
            // header("Location: ../views/admin/Bank.php");
            redirect("../views/login.php",false);

        }
        
        

        

    }
}
    



?>