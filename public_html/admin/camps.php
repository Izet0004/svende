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
    $camp = new Camp();
    $campList = $camp->listCampsOverview();
    $tableHead = ["Id","Title","Pladser", "Indstillinger"];
    echo htmlHelper::presentTable($tableHead, $campList, '<a class="a-fix" href="?mode=details&id=@id"><i class="material-icons">search</i></a>
    <a class="a-fix" href="?mode=edit&id=@id"><i class="material-icons" >create</i></a>
    <a class="a-fix" href="?mode=delete&id=@id"><i class="material-icons delete" >delete</i></a>',
    'id');
    break;
    case "DETAILS":
    $id = (int)$_GET["id"];
    if($id > 0){
        $camp = new Camp();
        $campDetails = $camp->getCamp($id);
        unset($campDetails[0]["img_path"]);
        echo htmlHelper::presentList(["Id: ", "Title: ", "Beskrivelse: ","Pladser: "], $campDetails);
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $camp = new Camp();
    $row = $camp->getCampSingle($id);
    echo '<form action="?mode=save&id='.$camp->id.'" method="POST" enctype="multipart/form-data">';
    echo htmlHelper::presentInput("title", "Title", "text", $camp->title, $camp->title, "", "required");
    echo htmlHelper::presentWysiwyg("description", "Beskrivelse",$camp->description, 3, "required");
    echo htmlHelper::presentPicture("Nuværende billede","../assets/data/fotos/indhold/", $camp->img_path, $camp->title, "height='200px' width='200px'");
    echo htmlHelper::presentInput("img_path", "Billede", "file", $camp->img_path, $camp->img_path, "", "");
    echo htmlHelper::presentInput("space", "Pladser", "number", $camp->space, $camp->space, "", "required");
    echo '<button type="submit" name="" id="" class="btn btn-primary" style="width=100%" btn-lg btn-block">Gem</button>';
    echo '</form>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $camp = new Camp();
        $row = $camp->getCampSingle($id);
        !empty($_POST["isSuspended"]) ? $suspend = 1 : $suspend = 0;
        if(!empty($_POST)){
            empty($_FILES["img_path"]["name"]) ? $avatarName = $camp->img_path : $avatarName = $camp->uploadCampImg($_FILES["img_path"]);
            $camp->saveCamp([
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["title"], FILTER_SANITIZE_STRING),
                $_POST["description"],
                filter_var($avatarName, FILTER_SANITIZE_STRING),
                filter_var($_POST["space"], FILTER_SANITIZE_STRING)
            ]);
            echo '<script> location.replace("camps.php"); </script>';
        }
    } else {
        // insert
        $camp = new Camp();
        if(!empty($_POST)){
            empty($_FILES["img_path"]["name"]) ? $avatarName = "stock.jpg" : $avatarName = $camp->uploadCampImg($_FILES["avatar"]);
            $camp->createCamp([
                filter_var($_POST["title"], FILTER_SANITIZE_STRING),
                $_POST["description"],
                filter_var($_POST["author"], FILTER_SANITIZE_STRING),
                filter_var($avatarName, FILTER_SANITIZE_STRING),
                filter_var($_POST["photograph"], FILTER_SANITIZE_STRING),
            ]);
        }
    }
    break;
    case "DELETE":
    $id = (int)$_GET["id"];
    if($id > 0){
        $camp = new Camp();
        $camp->deleteCamp($id);
    }
    echo '<script> location.replace("camps.php"); </script>';
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
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });
</script>