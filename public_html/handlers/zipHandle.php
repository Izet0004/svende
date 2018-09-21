<?php
require_once("../assets/incl/init.php");
if(isset($_POST["zip"])){
    $zip = filter_var($_POST["zip"], FILTER_SANITIZE_STRING);
    if($zip > 0){
        getCity($zip);
    }
} 

function getCity($zip){
    $zipObj = new Zip();
    if($zipObj->getCityByZip($zip)){
        echo $zipObj->getCityByZip($zip);
    } else {
        echo "Invalid zip";
    }
}
?>