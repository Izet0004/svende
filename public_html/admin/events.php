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
    $event = new Event();
    $eventList = $event->listEventOverview();
    $tableHead = ["Id","Dato", "Navn", "Scene","Indstillinger"];
    echo htmlHelper::presentTable($tableHead, $eventList, '<a class="a-fix" href="?mode=details&id=@id"><i class="material-icons">search</i></a>
    <a class="a-fix" href="?mode=edit&id=@id"><i class="material-icons" >create</i></a>
    <a class="a-fix" href="?mode=delete&id=@id"><i class="material-icons delete" >delete</i></a>',
    'id');
    break;
    case "DETAILS":
    $id = (int)$_GET["id"];
    if($id > 0){
        $event = new Event();
        $eventDetails = $event->getEvent($id);
        unset($eventDetails[0]["artist_id"]);
        unset($eventDetails[0]["scene_id"]);
        unset($eventDetails[1]);
        // var_dump($eventDetails);
        echo htmlHelper::presentList(["Id: ", "Dato: ","Navn: ","Scene: ", "Beskrivelse: ", "Genre: "], $eventDetails);
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $event = new Event();
    $artist = new Artist();
    $scene = new Scene();
    $genre = new Genre();
    $artistList = $artist->listArtists();
    $sceneList = $scene->listScenes();
    $genreList = $genre->listGenres();
    $row = $event->getEventSingle($id);
    echo '<form action="?mode=save&id='.$event->id.'" method="POST" enctype="multipart/form-data">';
    echo htmlHelper::presentSelect("artist", $artistList, "id", "name", $event->artist_id, "Vælg Artist");
    echo htmlHelper::presentSelect("scene", $sceneList, "id", "title", $event->scene_id, "Vælg Scene");
    echo htmlHelper::presentDate("date","Tid", $event->date);
    echo htmlHElper::presentCheckBox("genre[]", $genreList, "id", "title", $event->genre_id);
    echo '<button type="submit" name="" id="" class="btn btn-primary" style="width:100%" btn-lg btn-block">Gem</button>';
    echo '</form>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $event = new Event();
        $row = $event->getEventSingle($id);
        if(!empty($_POST)){
            $event->saveEvent([
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["artist"], FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["scene"], FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["date"], FILTER_SANITIZE_STRING),
                $_POST["genre"]
            ]);
            echo '<script> location.replace("events.php"); </script>';
        }
    } else {
        // insert
        $event = new Event();
        if(!empty($_POST)){
            empty($_FILES["img_path"]["name"]) ? $avatarName = $event->img_path : $avatarName = $event->uploadEventImg($_FILES["img_path"]);
            $event->createEvent([
                filter_var($_POST["name"], FILTER_SANITIZE_STRING),
                filter_var($_POST["description"], FILTER_SANITIZE_STRING),
                filter_var($avatarName, FILTER_SANITIZE_STRING),
                filter_var($_POST["type"], FILTER_SANITIZE_NUMBER_INT)
            ]);
        }
        echo '<script> location.replace("events.php"); </script>';
    }
    break;
    case "DELETE":
    $id = (int)$_GET["id"];
    if($id > 0){
        $event = new Event();
        $event->deleteEvent($id);
    }
    echo '<script> location.replace("events.php"); </script>';
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