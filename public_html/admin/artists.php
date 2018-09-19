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
    $artist = new Artist();
    $artistList = $artist->listArtistOverview();
    $tableHead = ["Id","Navn", "Type",  "Indstillinger"];
    echo htmlHelper::presentTable($tableHead, $artistList, '<a class="a-fix" href="?mode=details&id=@id"><i class="material-icons">search</i></a>
    <a class="a-fix" href="?mode=edit&id=@id"><i class="material-icons" >create</i></a>
    <a class="a-fix" href="?mode=delete&id=@id"><i class="material-icons delete" >delete</i></a>',
    'id');
    break;
    case "DETAILS":
    $id = (int)$_GET["id"];
    if($id > 0){
        $artist = new Artist();
        $artistDetails = $artist->getArtist($id);
        unset($artistDetails[0]["img_path"]);
        echo htmlHelper::presentList(["Id: ", "Title: ", "Beskrivelse: "], $artistDetails);
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $artist = new Artist();
    $type = new Type();
    $typeList = $type->listTypes();
    $row = $artist->getArtistSingle($id);
    echo '<form action="?mode=save&id='.$artist->id.'" method="POST" enctype="multipart/form-data">';
    echo htmlHelper::presentInput("name", "Navn", "text", $artist->name, $artist->name, "", "required");
    echo htmlHelper::presentInput("description", "Beskrivelse", "text", htmlspecialchars($artist->description), htmlspecialchars($artist->description), "", "required");
    echo htmlHelper::presentPicture("Nuværende billede","../assets/data/fotos/artister/", $artist->img_path, $artist->img_path, "height='200px' width='200px'");
    echo htmlHelper::presentInput("img_path", "Billede", "file", $artist->img_path, $artist->img_path, "", "");
    // var_dump($typeList);
    // var_dump(array_merge($typeList));
    // foreach ($typeList as $key => $value) {
    //     var_dump($value["title"]);
    // }
    echo htmlHelper::presentSelect("type", $typeList, "id", "title", $artist->type_id);
    echo '<button type="submit" name="" id="" class="btn btn-primary" style="width=100%" btn-lg btn-block">Gem</button>';
    echo '</form>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $artist = new Artist();
        $row = $artist->getArtistSingle($id);
        if(!empty($_POST)){
            empty($_FILES["img_path"]["name"]) ? $avatarName = $artist->img_path : $avatarName = $artist->uploadArtistImg($_FILES["img_path"]);
            $artist->saveArtist([
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["name"], FILTER_SANITIZE_STRING),
                filter_var($_POST["description"], FILTER_SANITIZE_STRING),
                filter_var($avatarName, FILTER_SANITIZE_STRING),
                filter_var($_POST["type"], FILTER_SANITIZE_NUMBER_INT)
            ]);
            echo '<script> location.replace("artists.php"); </script>';
        }
    } else {
        // insert
        $artist = new Artist();
        if(!empty($_POST)){
            empty($_FILES["img_path"]["name"]) ? $avatarName = $artist->img_path : $avatarName = $artist->uploadArtistImg($_FILES["img_path"]);
            $artist->createArtist([
                filter_var($_POST["name"], FILTER_SANITIZE_STRING),
                filter_var($_POST["description"], FILTER_SANITIZE_STRING),
                filter_var($avatarName, FILTER_SANITIZE_STRING),
                filter_var($_POST["type"], FILTER_SANITIZE_NUMBER_INT)
            ]);
        }
        echo '<script> location.replace("artists.php"); </script>';
    }
    break;
    case "DELETE":
    $id = (int)$_GET["id"];
    if($id > 0){
        $artist = new Artist();
        $artist->deleteArtist($id);
    }
    echo '<script> location.replace("artists.php"); </script>';
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