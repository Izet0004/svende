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
    $tableHead = ["Id","Username", "First Name", "Last Name", "Options"];
    echo htmlHelper::presentTable($tableHead, $users, '<i class="material-icons" onClick="showUserDetails(@id)">search</i>
    <i class="material-icons" onClick="editUser(@id)">create</i>', 'user_id');
}
function userDetails($userId){
    $user = new User();
    $userDetails = $user->getUser($userId);
    unset($userDetails[0]["img_path"]);
    $userDetails[0]["is_suspended"] == 0 ? $userDetails[0]["is_suspended"] = "No" : $userDetails[0]["is_suspended"] = "Yes";
    echo '<div>';
    // echo htmlHelper::presentTable(["Id", "Username", "First Name", "Last Name", "Email", "Suspended", "Date Created"], $userDetails);
    echo htmlHelper::presentList(["Id: ", "Username: ", "First Name: ", "Last Name: ", "Email: ", "Suspended: ", "Date Created: "], $userDetails);
    echo '</div>';
}
function editUser($userId){
    $user = new User();
    $user->getUserSingle($userId);
    echo htmlHelper::presentHidden("userId", $userId);
    echo htmlHelper::presentInput("username", "Brugernavn", "text", $user->username, $user->username, "");
    echo htmlHelper::presentInput("firstName", "Fornavn", "text", $user->firstName, $user->firstName, "");
    echo htmlHelper::presentInput("lastName", "Efternavn", "text", $user->lastName, $user->lastName, "");
    echo htmlHelper::presentInput("phone", "Tlf", "text", $user->phone, $user->phone, "");
    echo htmlHelper::presentInput("email", "Email", "text", $user->email, $user->email, "");
    echo htmlHelper::presentInput("address", "Addresse", "text", $user->address, $user->address, "");
    echo htmlHelper::presentInput("zip", "Post nr.", "text", $user->zip, $user->zip, "");
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
function saveUser($data){
    // var_dump($data);
    $user = new User();
    if(isset($data["userId"]->value)){
        // echo $data;
        $user->test($data);
        
    } else {
        // echo $data;
        $user->testt($data);
    }
}
?>