<?php
$pageTitle = "Vandrestøvlen";
$errorMsg = "";
$username = "";
$password = "";
$roleId = 0;
$error = false;
include_once("assets/incl/init.php");
// NOTE FOR MYSELF
// ID SHOULD MAYBE BE ENCRYPTED?
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['profile_id'])){
        if($_GET['profile_id'] == $auth->userId){
            $error = false;
        }
        else {
            $error = true;
        }
    }
}
var_dump($auth->userId);
?>
<?php if(!$error): ?>
You are viewing your profile bru ;D
<?php else: ?>
Not your id bru
<?php endif; ?>
<?php
include_once("assets/incl/footer.php");
?>