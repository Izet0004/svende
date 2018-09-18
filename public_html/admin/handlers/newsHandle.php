<?php
require_once("../assets/incl/init.php");

// View user details
if(isset($_POST["newsId"]) && isset($_POST["details"])){
    $newsId = filter_var($_POST["newsId"], FILTER_SANITIZE_STRING);
    if($newsId > 0){
        // Viewing news details
        newsDetails($newsId);
    }
} 
// Edit user, show user inputs with values
elseif(isset($_POST["newsId"]) && isset($_POST["edit"])){
    $newsId = filter_var($_POST["newsId"], FILTER_SANITIZE_STRING);
    if($newsId > 0){
        editnews($newsId);
    } else {
        createNews();
    }
}
elseif(isset($_POST["newsId"]) && isset($_POST["delete"])){
    $newsId = filter_var($_POST["newsId"], FILTER_SANITIZE_STRING);
    if($userId > 0){
        // Viewing user details
        deleteNews($newsId);
    }
}
elseif(isset($_POST["listNews"])){
    // List News
    listNews();
}
// Save user
// If id>0 edit
// Else Create
elseif(isset($_POST["save"]) && isset($_POST["data"])){
    $arrData = json_decode((String)$_POST["data"]);
    $finalData = array_column($arrData, null, "name");
    $news = new News();
    saveNews($finalData);
    // VI SKAL HAVE ID MED IND I FINAL DATA
} 
function listNews(){
    $news = new News();
    $newsList = $news->listNewsOverview();
    $tableHead = ["Id","Title", "Date", "Options"];
    echo htmlHelper::presentTable($tableHead, $newsList, '<i class="material-icons" onClick="showNewsDetails(@id)">search</i>
    <i class="material-icons" onClick="editNews(@id)">create</i><i class="material-icons" onClick="deleteUser(@id)">delete</i>', 'id');
}
function newsDetails($newsId){
    $news = new News();
    $newsDetails = $news->getNews($newsId);
    // unset($newsDetails[0]["img_path"]);
    echo '<div>';
    // echo htmlHelper::presentTable(["Id", "Username", "First Name", "Last Name", "Email", "Suspended", "Date Created"], $userDetails);
    unset($newsDetails[0]["img_path"]);
    echo htmlHelper::presentList(["Id: ", "Title: ", "Beskrivelse: ","Forfatter: ", "Fotograf: ", "Udgivet: "], $newsDetails);
    echo '</div>';
}
function editNews($newsId){
    $news = new News();
    $news->getNewsSingle($newsId);
    // echo htmlHelper::presentHidden("userId", $userId);
    // echo htmlHelper::presentInput("name", "Navn", "text", $user->name, $user->name, "", "required pattern='[A-Za-z]+'");
    // echo htmlHelper::presentInput("email", "Email", "text", $user->email, $user->email, "", "required");
    // echo htmlHelper::presentInput("address", "Addresse", "text", $user->address, $user->address, "", "required");
    // echo htmlHelper::presentInput("zip", "Post nr.", "text", $user->zip, $user->zip, "", "required");
    // $userSusp = [];
    // $userRoles = [];
    // $user->isSuspended == 0 ? $userSusp = "Nej" : $userSusp = "Ja";
    // echo htmlHelper::presentOptions("Suspenderet","isSuspended", ["Ja", "Nej"], $userSusp);
    // $user->roleId == 1 ? $userRoles = "Admin" : $userRoles = "Extranet";
    // echo htmlHelper::presentOptions("Rolle","role", ["Admin", "Extranet"], $userRoles);
    echo htmlHelper::presentHidden("newsId", $newsId);
    echo htmlHelper::presentInput("title", "Title", "text", $news->title, $news->title, "", "required");
    echo htmlHelper::presentInput("description", "Beskrivelse", "text", $news->description, $news->description, "", "required");
    echo htmlHelper::presentInput("author", "Forfatter", "text", $news->author, $news->author, "", "required");
    echo htmlHelper::presentInput("img_path", "Billede", "file", $news->img_path, $news->img_path, "", "");
    echo htmlHelper::presentInput("photograph", "Fotograf", "text", $news->photograph, $news->photograph, "", "required");

}
function createNews(){
    echo htmlHelper::presentInput("name", "Navn", "text", "", "", "", "required pattern='[A-Za-z]+'");
    echo htmlHelper::presentInput("email", "Email", "text", "", "", "", "required");
    echo htmlHelper::presentInput("password", "Password", "password", "", "", "", "required");
    echo htmlHelper::presentInput("address", "Addresse", "text","","", "", "required");
    echo htmlHelper::presentInput("zip", "Post nr.", "text", "", "", "", "required");
    echo htmlHelper::presentOptions("Rolle","role", ["Admin", "Extranet"],[1,2]);
}
function deleteNews($id){
    $news = new News();
    if($id > 0){
        $news->deleteNews($id);
    }
}
function saveNews($data){
    $news = new News();
    // If userId is set, we update user, else create user
    if(isset($data["newsId"]->value)){
        $news->saveNews($data);
        
    } else {
        $news->createNews($data);
    }
}
?>