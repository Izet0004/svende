<?php
$username = "";
$password = "";
$roleId = 0;
$errorLogin = false;
include_once("assets/incl/init.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"])) || empty(trim($_POST["password"]))){
        $errorLogin = true;
    } else {
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    }

    if($errorLogin == false){
        $user = new User();
        if($user->checkUser($username, $password)){
            $auth->userId = $user->id;
            if($auth->isAdmin()){
                header("location: admin/index.php");
                exit();
            } else if($auth->isMember()){
                header("location: index.php");
                exit();
            }
        } else {
            $errorLogin = true;
            $errorMsg = "Forkert lelele";
            header("location: index.php");
        }
    }
}
?>
