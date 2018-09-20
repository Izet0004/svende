<?php
$pageTitle = "Artist Details";
require("assets/incl/header.php");
$event_id = 0;
if(isset($_GET["event_id"])){
    $event_id = filter_var($_GET["event_id"], FILTER_SANITIZE_STRING);
} else {
    $event_id = 229;
}
$event = new Event();
// var_dump($event_id);
$event->getEventSingle($event_id);
$colorClass = "";

switch ($event->scene_id) {
    case 1:
        $colorClass = "bg-red";
        break;
    case 2:
        $colorClass = "bg-green";
        break;
    case 3:
    $colorClass = "bg-blue";
        break;
    case 4:
    $colorClass = "bg-purple";
        break;
    default:
        $colorClass = "bg-red";
        break;
}
// var_dump($event);
$dateTime = new Date();
?>
<?php if(!empty($event->name)) :?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 artist-details-head <?php echo $colorClass ?> white p-2 pad-sides">
            <h2><?php echo mb_strtoupper($event->scene_name, 'UTF-8')?> : <?php echo $dateTime->convertToTime($event->date)?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 artist-details-info">
            <h2><?php echo $event->name?></h2>
            <img src="../assets/data/fotos/artister/<?php echo $event->img_path?>" class="img-fluid float-right" width="400px" height="400px" alt="artist image">
            <p><?php echo $event->description?></p>
        </div>
    </div>
</div>
<?php else: ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 artist-details-head bg-red white p-2 pad-sides">
            <h2>RØD SCENE : kl 23:00</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2>Lorem lorem</h2>
            <img src="/assets/data/fotos/indhold/camel-foto-colourbox.jpg" class="img-fluid float-right" width="400px" height="400px" alt="">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis, eveniet facere repellat ab repudiandae
                fugit deb, debitis, soluta asperiores mollitia delectus veritatis, est ad consectetur doloribus.</p>
        </div>
    </div>
</div>
<?php endif; ?>
<script src="assets/js/modal.js"></script>
<?php require("assets/incl/footer.php")?>