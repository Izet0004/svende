<?php
require_once("../assets/incl/init.php");

// View user details
if(isset($_POST["userId"]) && isset($_POST["details"])){
    $userId = filter_var($_POST["userId"], FILTER_SANITIZE_STRING);
    if($userId > 0){
        // Viewing user details
        userDetails($userId);
    }
} 
// Edit user, show user inputs with values
elseif(isset($_POST["userId"]) && isset($_POST["edit"])){
    $userId = filter_var($_POST["userId"], FILTER_SANITIZE_STRING);
    if($userId > 0){
        editUser($userId);
    } else {
        createUser();
    }
}
elseif(isset($_POST["userId"]) && isset($_POST["delete"])){
    $userId = filter_var($_POST["userId"], FILTER_SANITIZE_STRING);
    if($userId > 0){
        // Viewing user details
        deleteUser($userId);
    }
}
elseif(isset($_POST["listUsers"])){
    // List users
    listUsers();
}
// Save user
// If id>0 edit
// Else Create
elseif(isset($_POST["save"]) && isset($_POST["data"])){
    $arrData = json_decode((String)$_POST["data"]);
    $finalData = array_column($arrData, null, "name");
    $user = new User();
    saveUser($finalData);
    // VI SKAL HAVE ID MED IND I FINAL DATA
} 
function listUsers(){
    $user = new User();
    $users = $user->listUsers();
    $tableHead = ["Id","Email", "Name", "Options"];
    echo htmlHelper::presentTable($tableHead, $users, '<i class="material-icons" onClick="showUserDetails(@id)">search</i>
    <i class="material-icons" onClick="editUser(@id)">create</i><i class="material-icons" onClick="deleteUser(@id)">delete</i>', 'user_id');
}
function userDetails($userId){
    $user = new User();
    $userDetails = $user->getUser($userId);
    unset($userDetails[0]["img_path"]);
    $userDetails[0]["is_suspended"] == 0 ? $userDetails[0]["is_suspended"] = "No" : $userDetails[0]["is_suspended"] = "Yes";
    echo '<div>';
    // echo htmlHelper::presentTable(["Id", "Username", "First Name", "Last Name", "Email", "Suspended", "Date Created"], $userDetails);
    echo htmlHelper::presentList(["Id: ", "Email: ", "Name: ","Address: ","Zip: ", "Suspended: ", "Date Created: "], $userDetails);
    echo '</div>';
}
function editUser($userId){
    $user = new User();
    $user->getUserSingle($userId);
    echo htmlHelper::presentHidden("userId", $userId);
    echo htmlHelper::presentInput("name", "Navn", "text", $user->name, $user->name, "required");
    echo htmlHelper::presentInput("email", "Email", "text", $user->email, $user->email, "required");
    echo htmlHelper::presentInput("address", "Addresse", "text", $user->address, $user->address, "", "required");
    echo htmlHelper::presentInput("zip", "Post nr.", "text", $user->zip, $user->zip, "required");
    $userSusp = [];
    $user->isSuspended == 0 ? $userSusp = "Nej" : $userSusp = "Ja";
    echo htmlHelper::presentOptions("Suspenderet","isSuspended", ["Ja", "Nej"], $userSusp);
}
function createUser(){
    echo htmlHelper::presentInput("username", "Brugernavn", "text");
    echo htmlHelper::presentInput("password", "Password", "text");
    echo htmlHelper::presentInput("firstName", "Fornavn", "text");
    echo htmlHelper::presentInput("lastName", "Efternavn", "text");
    echo htmlHelper::presentInput("phone", "Tlf", "text");
    echo htmlHelper::presentInput("email", "Email", "text");
    echo htmlHelper::presentInput("address", "Addresse", "text");
    echo htmlHelper::presentInput("zip", "Post nr.", "text", "", "", "zipInput");
    echo htmlHelper::presentInput("city", "By", "text", "", "", "cityOutput", "", "disabled");
}
function deleteUser($id){
    $user = new User();
    if($id > 0){
        $user->deleteUser($id);
    }
}
function saveUser($data){
    $user = new User();
    // If userId is set, we update user, else create user
    if(isset($data["userId"]->value)){
        $user->saveUser($data);
        
    } else {
        $user->createUser($data);
    }
}
?>