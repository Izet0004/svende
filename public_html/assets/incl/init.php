<?php
/* Define Document Root */
define("DOCROOT", filter_input(INPUT_SERVER, "DOCUMENT_ROOT", FILTER_SANITIZE_STRING));
/* Define Core Root */
define("COREPATH", substr(DOCROOT, 0, strrpos(DOCROOT,"/")) . "/core/");
require_once(COREPATH . "classes/autoloader.php");
$db = new db();
$auth = new auth();
$pdo = db::$pdo;
if(isset($_GET["logout"])){
    session_unset();
    session_regenerate_id();
    header("Location: index.php");
}
?>