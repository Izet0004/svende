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
    $scene = new Scene();
    $sceneList = $scene->listScenes();
    $tableHead = ["Id","Title", "Indstillinger"];
    echo htmlHelper::presentTable($tableHead, $sceneList, '<a class="a-fix" href="?mode=details&id=@id"><i class="material-icons">search</i></a>
    <a class="a-fix" href="?mode=edit&id=@id"><i class="material-icons" >create</i></a>
    <a class="a-fix" href="?mode=delete&id=@id"><i class="material-icons delete" >delete</i></a>',
    'id');
    break;
    case "DETAILS":
    $id = (int)$_GET["id"];
    if($id > 0){
        $scene = new Scene();
        $sceneDetails = $scene->getScene($id);
        echo htmlHelper::presentList(["Id: ", "Title: "], $sceneDetails);
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $scene = new Scene();
    $row = $scene->getSceneSingle($id);
    echo '<form action="?mode=save&id='.$scene->id.'" method="POST" enctype="multipart/form-data">';
    echo htmlHelper::presentInput("title", "Title", "text", $scene->title, $scene->title, "", "required");
    echo '<button type="submit" name="" id="" class="btn btn-primary" style="width=100%" btn-lg btn-block">Gem</button>';
    echo '</form>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $scene = new Scene();
        $row = $scene->getSceneSingle($id);
        !empty($_POST["isSuspended"]) ? $suspend = 1 : $suspend = 0;
        if(!empty($_POST)){
            $scene->saveScene([
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["title"], FILTER_SANITIZE_STRING)
            ]);
            echo '<script> location.replace("scenes.php"); </script>';
        }
    } else {
        // insert
        $news = new News();
        if(!empty($_POST)){
            $scene->createScene([
                filter_var($_POST["title"], FILTER_SANITIZE_STRING)
            ]);
        }
    }
    break;
    case "DELETE":
    $id = (int)$_GET["id"];
    if($id > 0){
        $scene = new Scene();
        $scene->deleteScene($id);
    }
    echo '<script> location.replace("scenes.php"); </script>';
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