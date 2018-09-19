<?php include_once("assets/incl/header.php")?>
<?php
$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);
if(empty($mode)) { $mode = filter_input(INPUT_GET, "mode", FILTER_SANITIZE_STRING);}
if(empty($mode)) { $mode = "list"; }

switch(strtoupper($mode)){
    default:
    $mode = "LIST";
    break;
    case "LIST":
    echo '<div class="create-button"><a name="" id="" class="btn btn-secondary" href="?mode=edit&id=0" role="button">Opret</a></div>';
    $newsletter = new Newsletter();
    $newsletterList = $newsletter->listNewsletters();
    $tableHead = ["Id","Title", "Indstillinger"];
    echo htmlHelper::presentTable($tableHead, $newsletterList, '<a class="a-fix" href="?mode=details&id=@id"><i class="material-icons">search</i></a>
    <a class="a-fix" href="?mode=edit&id=@id"><i class="material-icons" >create</i></a>
    <a class="a-fix" href="?mode=delete&id=@id"><i class="material-icons delete" >delete</i></a>',
    'id');
    break;
    case "DETAILS":
    $id = (int)$_GET["id"];
    if($id > 0){
        $newsletter = new Newsletter();
        $newsletterDetails = $newsletter->getNewsletter($id);
        echo htmlHelper::presentList(["Id: ", "Title: "], $newsletterDetails);
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $newsletter = new Newsletter();
    $row = $newsletter->getNewsletterSingle($id);
    echo '<form action="?mode=save&id='.$newsletter->id.'" method="POST" encnewsletter="multipart/form-data">';
    echo htmlHelper::presentInput("email", "Email", "email", $newsletter->email, $newsletter->email, "", "required");
    echo '<button newsletter="submit" name="" id="" class="btn btn-primary" style="width=100%" btn-lg btn-block">Gem</button>';
    echo '</form>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $newsletter = new Newsletter();
        $row = $newsletter->getNewsletterSingle($id);
        !empty($_POST["isSuspended"]) ? $suspend = 1 : $suspend = 0;
        if(!empty($_POST)){
            $newsletter->saveNewsletter([
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["email"], FILTER_SANITIZE_STRING)
            ]);
            echo '<script> location.replace("newsletters.php"); </script>';
        }
    } else {
        // insert
        $newsletter = new Newsletter();
        if(!empty($_POST)){
            $newsletter->createNewsletter([
                filter_var($_POST["email"], FILTER_SANITIZE_STRING)
            ]);
        }
        echo '<script> location.replace("newsletters.php"); </script>';
    }
    break;
    case "DELETE":
    $id = (int)$_GET["id"];
    if($id > 0){
        $newsletter = new Newsletter();
        $newsletter->deleteNewsletter($id);
    }
    echo '<script> location.replace("newsletters.php"); </script>';
}

?>
<?php include_once("assets/incl/footer.php")?>
<script>
    $(document).ready(function () {
        $(".delete").click(function () {
            return confirm("Vil du slette " + this.id + "?");
        });
    });
</script>