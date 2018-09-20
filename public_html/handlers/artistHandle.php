<?php
include_once("../assets/incl/init.php");
if(isset($_POST["id"])){
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $artistObj = new Artist();
    $artistObj->getArtist($id);
    echo '<div class="modal-head"></div>';
    echo '<div class="modal-body">';
    echo '<div><h2>'.$artistObj->name.'<h2></div>';
    echo '<div><img height="200px" width="200px" src="../assets/data/fotos/artister/'.$artistObj->img_path.'"></div>';
    echo '<div><p>'.$artistObj->description.'</p></div>';
    echo '</div>';
}

?>