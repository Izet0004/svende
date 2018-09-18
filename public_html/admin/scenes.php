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
    $news = new News();
    $newsList = $news->listNewsOverview();
    $tableHead = ["Id","Title","Udgivet"];
    echo htmlHelper::presentTable($tableHead, $newsList, '<a class="a-fix" href="?mode=details&id=@id"><i class="material-icons">search</i></a>
    <a class="a-fix" href="?mode=edit&id=@id"><i class="material-icons" >create</i></a>
    <a class="a-fix" href="?mode=delete&id=@id"><i class="material-icons delete" >delete</i></a>',
    'id');
    break;
    case "DETAILS":
    $id = (int)$_GET["id"];
    if($id > 0){
        $news = new News();
        $newsDetails = $news->getNews($id);
        unset($newsDetails[0]["img_path"]);
        echo htmlHelper::presentList(["Id: ", "Title: ", "Beskrivelse: ","Forfatter: ", "Fotograf: ", "Udgivet: "], $newsDetails);
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $news = new News();
    $row = $news->getNewsSingle($id);
    echo '<form action="?mode=save&id='.$news->id.'" method="POST" enctype="multipart/form-data">';
    echo htmlHelper::presentInput("title", "Title", "text", $news->title, $news->title, "", "required");
    echo htmlHelper::presentInput("description", "Beskrivelse", "text", htmlspecialchars($news->description), htmlspecialchars($news->description), "", "required");
    echo htmlHelper::presentInput("author", "Forfatter", "text", $news->author, $news->author, "", "required");
    echo htmlHelper::presentPicture("Nuværende billede","../assets/data/fotos/indhold/", $news->img_path, $news->title, "height='200px' width='200px'");
    echo htmlHelper::presentInput("img_path", "Billede", "file", $news->img_path, $news->img_path, "", "");
    echo htmlHelper::presentInput("photograph", "Fotograf", "text", $news->photograph, $news->photograph, "", "required");
    echo '<button type="submit" name="" id="" class="btn btn-primary" style="width=100%" btn-lg btn-block">Gem</button>';
    echo '</form>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $news = new News();
        $row = $news->getNewsSingle($id);
        !empty($_POST["isSuspended"]) ? $suspend = 1 : $suspend = 0;
        if(!empty($_POST)){
            empty($_FILES["img_path"]["name"]) ? $avatarName = $news->img_path : $avatarName = $news->uploadNewsImg($_FILES["img_path"]);
            $news->saveNews([
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["title"], FILTER_SANITIZE_STRING),
                filter_var($_POST["description"], FILTER_SANITIZE_STRING),
                filter_var($_POST["author"], FILTER_SANITIZE_STRING),
                filter_var($avatarName, FILTER_SANITIZE_STRING),
                filter_var($_POST["photograph"], FILTER_SANITIZE_STRING),
            ]);
            echo '<script> location.replace("news.php"); </script>';
        }
    } else {
        // insert
        $news = new News();
        if(!empty($_POST)){
            empty($_FILES["img_path"]["name"]) ? $avatarName = "stock.jpg" : $avatarName = $news->uploadNewsImg($_FILES["avatar"]);
            $news->createNews([
                filter_var($_POST["title"], FILTER_SANITIZE_STRING),
                filter_var($_POST["description"], FILTER_SANITIZE_STRING),
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
        $news = new News();
        $news->deleteNews($id);
    }
    echo '<script> location.replace("news.php"); </script>';
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