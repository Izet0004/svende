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
    $genre = new Genre();
    $genreList = $genre->listGenres();
    $tableHead = ["Id","Title", "Indstillinger"];
    echo htmlHelper::presentTable($tableHead, $genreList, '<a class="a-fix" href="?mode=details&id=@id"><i class="material-icons">search</i></a>
    <a class="a-fix" href="?mode=edit&id=@id"><i class="material-icons" >create</i></a>
    <a class="a-fix" href="?mode=delete&id=@id"><i class="material-icons delete" >delete</i></a>',
    'id');
    break;
    case "DETAILS":
    $id = (int)$_GET["id"];
    if($id > 0){
        $genre = new Genre();
        $genreDetails = $genre->getGenre($id);
        echo htmlHelper::presentList(["Id: ", "Title: "], $genreDetails);
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $genre = new Genre();
    $row = $genre->getGenreSingle($id);
    echo '<form action="?mode=save&id='.$genre->id.'" method="POST" encgenre="multipart/form-data">';
    echo htmlHelper::presentInput("title", "Title", "text", $genre->title, $genre->title, "", "required");
    echo '<button genre="submit" name="" id="" class="btn btn-primary" style="width=100%" btn-lg btn-block">Gem</button>';
    echo '</form>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $genre = new Genre();
        $row = $genre->getGenreSingle($id);
        !empty($_POST["isSuspended"]) ? $suspend = 1 : $suspend = 0;
        if(!empty($_POST)){
            $genre->saveGenre([
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["title"], FILTER_SANITIZE_STRING)
            ]);
            echo '<script> location.replace("genres.php"); </script>';
        }
    } else {
        // insert
        $genre = new Genre();
        if(!empty($_POST)){
            $genre->createGenre([
                filter_var($_POST["title"], FILTER_SANITIZE_STRING)
            ]);
        }
        echo '<script> location.replace("genres.php"); </script>';
    }
    break;
    case "DELETE":
    $id = (int)$_GET["id"];
    if($id > 0){
        $genre = new Genre();
        $genre->deleteGenre($id);
    }
    echo '<script> location.replace("genres.php"); </script>';
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