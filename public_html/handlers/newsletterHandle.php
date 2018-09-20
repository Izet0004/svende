<?php
require_once("../assets/incl/init.php");
$emailRegex = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";
if(isset($_POST["newsletterEmail"])){
    $email = filter_var($_POST["newsletterEmail"], FILTER_SANITIZE_STRING);
    if(preg_match($emailRegex, $email)){
        $newsletter = new newsletter();
        try{
            $newsletter->signUp($email);
            echo 'Du er nu tilmeldt som: ' . $email;
        } catch(PDOException $e){
            // echo $e;
            echo "Email allerede tilmeldt";
        }
    } else {
        echo 'Ugyldig email';
    }
    
}
?>