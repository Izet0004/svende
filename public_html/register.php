<?php
$username = "";
$password = "";

$errorLogin = false;
$pageTitle = "Register";
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
            if($auth->isAdmin()){
                header("location: admin/index.php");
            } elseif($auth->isMember()) {
                header("location: index.php");
            }
        } else {
            $errorLogin = true;
        }
    }
}
include_once("assets/incl/header.php");
?>
    <section class="container login">
        <form class="col-lg-7 mx-auto" action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="" aria-describedby="helpId" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="" aria-describedby="helpId" placeholder="First name">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="" aria-describedby="helpId" placeholder="Last name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="avatar_path">Image</label>
                <input type="file" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Email">
            </div>
            <?php echo ($errorLogin ? "Please fill everything.." : ""); ?>
            <button type="submit" name="register" id="" class="btn btn-primary btn-lg btn-block">Login</button>
        </form>
    </section>
    <?php include_once("assets/incl/footer.php")?>