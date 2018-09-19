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
    $tableHead = ["Id","Dato", "Navn", "Scene",  "Indstillinger"];
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
        unset($eventDetails[0]["img_path"]);
        echo htmlHelper::presentList(["Id: ", "Title: ", "Beskrivelse: "], $eventDetails);
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $event = new Event();
    $type = new Type();
    $typeList = $type->listTypes();
    $row = $event->getEventSingle($id);
    echo '<form action="?mode=save&id='.$event->id.'" method="POST" enctype="multipart/form-data">';
    echo htmlHelper::presentInput("name", "Navn", "text", $event->name, $event->name, "", "required");
    echo htmlHelper::presentInput("description", "Beskrivelse", "text", htmlspecialchars($event->description), htmlspecialchars($event->description), "", "required");
    echo htmlHelper::presentPicture("Nuværende billede","../assets/data/fotos/eventer/", $event->img_path, $event->img_path, "height='200px' width='200px'");
    echo htmlHelper::presentInput("img_path", "Billede", "file", $event->img_path, $event->img_path, "", "");
    // var_dump($typeList);
    // var_dump(array_merge($typeList));
    // foreach ($typeList as $key => $value) {
    //     var_dump($value["title"]);
    // }
    echo htmlHelper::presentSelect("type", $typeList, "id", "title", $event->type_id);
    echo '<button type="submit" name="" id="" class="btn btn-primary" style="width=100%" btn-lg btn-block">Gem</button>';
    echo '</form>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $event = new Event();
        $row = $event->getEventSingle($id);
        if(!empty($_POST)){
            empty($_FILES["img_path"]["name"]) ? $avatarName = $event->img_path : $avatarName = $event->uploadEventImg($_FILES["img_path"]);
            $event->saveEvent([
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["name"], FILTER_SANITIZE_STRING),
                filter_var($_POST["description"], FILTER_SANITIZE_STRING),
                filter_var($avatarName, FILTER_SANITIZE_STRING),
                filter_var($_POST["type"], FILTER_SANITIZE_NUMBER_INT)
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