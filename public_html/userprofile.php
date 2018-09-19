<?php
$pageTitle = "Redigere bruger";
$error = false;
include_once("assets/incl/init.php");
include_once("assets/incl/header.php");
// NOTE FOR MYSELF
// ID SHOULD MAYBE BE ENCRYPTED?
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['profile_id'])){
        if((int)$_GET['profile_id'] === $auth->userId){
            $error = false;
        }
        else {
            $error = true;
        }
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST)){
        if($_POST["userId"] == $auth->userId){
            $user = new User();
            $user->updateUser([
                "userId" => filter_var($_POST["userId"], FILTER_SANITIZE_NUMBER_INT),
                "name" => filter_var($_POST["name"], FILTER_SANITIZE_STRING),
                "address" => filter_var($_POST["address"], FILTER_SANITIZE_STRING),
                "zip" => filter_var($_POST["zip"], FILTER_SANITIZE_NUMBER_INT)
            ]);
        } else {
            echo "Dont edit your Id, please.";
        }
    }
}
?>
<?php if(!$error): ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php 
            $user = new User();
            $user->getUserSingle($auth->userId);
            echo '<form action="#" method="POST" enctype="multipart/form-data">';
            echo htmlHelper::presentHidden("userId", $auth->userId);
            echo htmlHelper::presentInput("name", "Navn", "text", $user->name, $user->name, "", "required pattern='[A-Za-z]+'");
            echo htmlHelper::presentInput("address", "Addresse", "text", $user->address, $user->address, "", "required");
            echo htmlHelper::presentInput("zip", "Post nr.", "text", $user->zip, $user->zip, "", "required");
            echo '<button type="submit" name="" id="" class="btn btn-primary" style="width=100%" btn-lg btn-block">Gem</button>';
            echo '</form>';
            ?>
        </div>
    </div>
</div>
<?php else: ?>
<?php (int)$_GET['profile_id'] = $auth->userId;?>
<?php endif; ?>
<?php
include_once("assets/incl/footer.php");
?>