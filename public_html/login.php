<?php
// echo password_hash("admin", PASSWORD_BCRYPT);
// exit();
include_once("assets/incl/init.php");
$pageTitle = "Login";
$errorLogin = false;
$errorMsg = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"])) || empty(trim($_POST["password"]))){
        $errorLogin = true;
        $errorMsg = "Indtast noget";
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
            $errorMsg = "Forkerte oplysninger";
        }
    }
}
require("assets/incl/header.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 p-0">
            <img src="assets/images/login-pic.jpg" alt="hero" class="full-img">
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <p class="font-36 text-center p-2">LOGIN</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <form class="col-lg-6 login-form" method="POST" action="#">
            <p class="font-32">Indtast oplysninger</p>
            <div class="form-group">
                <label for="username">Email/Brugernavn</label>
                <input type="email" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Indtast din email"
                required maxlength="100">
            </div>
            <div class="form-group">
                <label for="password">Adgangskode:</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" required
                    placeholder="Indtast din adgangskode">
            </div>
            <?php echo "<span class='red'>$errorMsg</span>"?>
            <div class="login-button">
                <button type="submit" class="white bg-blue font-26">LOGIN</button>
            </div>
            <a href="#">Glemt adgangskode?</a>
        </form>
    </div>
</div>
<?php require("assets/incl/footer.php")?>