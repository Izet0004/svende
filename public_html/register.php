<?php
include_once("assets/incl/init.php");
$pageTitle = "Login";
$errorLogin = false;
$errorMsg = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["name"])) || empty(trim($_POST["password"] || empty(trim($_POST["email"]  || empty(trim($_POST["zip"]))))))){
        $errorLogin = true;
        $errorMsg = "Indtast noget";
    } else {
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
        $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
        $zip = filter_var($_POST["zip"], FILTER_SANITIZE_NUMBER_INT);
    }

    if($errorLogin == false){
        $user = new User();
        if($user->createUsers($name, $address, $zip, $email, $password)){
            $errorMsg = "Du er nu registeret!";
        } else {
            $errorMsg = "Noget gik galt, prøv igen";
        }
    }
}
require("assets/incl/header.php");
?>
<div class="container">
    <form action="#" method="POST" class="register">
        <?php echo '<p>'.$errorMsg.'</p>';?>
        <div class="form-group">
            <label for="email">Email/Brugernavn</label>
            <input required type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Indtast din email">
        </div>
        <div class="form-group">
            <label for="password">Adgangskode:</label>
            <input required type="password" class="form-control" name="password" id="password" aria-describedby="helpId"
                placeholder="Indtast din adgangskode">
        </div>
        <div class="form-group">
            <label for="password2">Gentag adgangskode:</label>
            <input required type="password" class="form-control" name="password2" id="password2" aria-describedby="helpId"
                placeholder="Gentag adgangskode">
        </div>
        <div class="form-group">
            <label for="name">Navn:</label>
            <input required type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Indtast dit navn">
        </div>
        <div class="form-group">
            <label for="address">Addresse:</label>
            <input required type="text" class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Indtast din addresse">
        </div>
        <div class="form-group input-split">
            <div>
                <label for="zip">Post nr:</label>
                <input required type="number" class="form-control" name="zip" id="zipInput" aria-describedby="helpId"
                    placeholder="Indtast dit Post nr">
            </div>
            <div>
                <label for="city">By</label>
                <input type="text" class="form-control" name="city" id="cityOutput" aria-describedby="helpId" value=""
                    disabled placeholder="By:">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<?php require("assets/incl/footer.php")?>