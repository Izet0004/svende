<?php
function saveUser($data){
    $user = new User();
    // If userId is set, we update user, else create user
    if(isset($data["userId"]->value)){
        $user->saveUser($data);
    }
}
?>