<?php
$pdo = db::$pdo;
$user = new User();

$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);
if(empty($mode)) { $mode = filter_input(INPUT_GET, "mode", FILTER_SANITIZE_STRING);}
if(empty($mode)) { $mode = "list"; }
?>
    <?php switch (strtoupper($mode)): ?>
        <?php case("LIST"): ?>


    <?php endswitch ?>