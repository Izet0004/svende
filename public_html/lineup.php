<?php
$pageTitle = "Line-up";
require("assets/incl/header.php");
if(isset($_GET["filter"])){
    $filter = filter_var($_GET["filter"], FILTER_SANITIZE_STRING);
} else {
    $filter = "alpha";
}
$eventsFound = [];
$event = new Event();
$dateTime = new Date();
switch ($filter) {
    case 'alpha':
        $eventsFound = $event->getEventByAlpha();
        break;
    case 'redscene':
    $eventsFound = $event->getEventByScene(1);
    break;
    case 'greenscene':
        $eventsFound = $event->getEventByScene(2);
        break;
    case 'bluescene':
        $eventsFound = $event->getEventByScene(3);
        break;
    case 'purplescene':
        $eventsFound = $event->getEventByScene(4);
        break;
    case 'type':
        $typeId = 1;
        if(isset($_GET["type"])){
            $typeId = filter_var($_GET["type"], FILTER_SANITIZE_STRING);
        } else { $typeId = 1;}
        $eventsFound = $event->getEventByType($typeId);
        break;
    default:
        $eventsFound = $event->getEventByAlpha();
        break;
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center p-2">LINE-UP</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 line-up">
            <ul>
                <li><a href="lineup.php?filter=alpha" class="a-remove">A-Å</a></li>
                <li class="hover-red"><a href="lineup.php?filter=redscene" class="a-remove">RØD SCENE</a></li>
                <li class="hover-green"><a href="lineup.php?filter=greenscene" class="a-remove">GRØN SCENE</a></li>
                <li class="hover-blue"><a href="lineup.php?filter=bluescene" class="a-remove">BLÅ SCENE</a></li>
                <li class="hover-purple"><a href="lineup.php?filter=purplescene" class="a-remove">LILLA SCENE</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle a-remove" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        FILTER
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="lineup.php?filter=type&type=1">Musik</a>
                        <a class="dropdown-item" href="lineup.php?filter=type&type=2">Stand-up</a>
                        <a class="dropdown-item" href="lineup.php?filter=type&type=3">Film</a>
                        <a class="dropdown-item" href="lineup.php?filter=type&type=4">Andet</a>
                    </div>
                </li>
                <!-- <li><a href="#" class="a-remove ">FILTER</a></li> -->
            </ul>
        </div>
    </div>
    <div class="row">
        <?php foreach($eventsFound as $event) : ?>
        <figure class="col-lg-4 line-up-bands">
            <img class="full-img" src="/assets/data/fotos/artister/<?php echo $event['img_path']?>" alt="dad">
            <figcaption class="<?php if($event["scene_id"] == 1){
                echo 'bg-red';
            } elseif($event["scene_id"] == 2){
                echo 'bg-green';
            } elseif($event["scene_id"] == 3){
                echo 'bg-blue';
            } elseif($event["scene_id"] == 4){
                echo 'bg-purple';
            } ?>">
                <?php //var_dump($event)?>
                <p>
                    <?php echo $event["name"]?>
                </p>
                <p><?php echo $dateTime->convertToDayAndTime($event["date"]); ?></p>
            </figcaption>
        </figure>
        <?php endforeach; ?>
        <!-- <figure class="col-lg-4 line-up-bands">
            <img class="full-img" src="assets/images/dad.jpg" alt="dad">
            <figcaption>
                <p>D-A-D</p>
                <p>Torsdag kl. 23:00</p>
            </figcaption>
        </figure>
        <figure class="col-lg-4 line-up-bands">
            <img class="full-img" src="assets/images/dad.jpg" alt="dad">
            <figcaption>
                <p>D-A-D</p>
                <p>Torsdag kl. 23:00</p>
            </figcaption>
        </figure>
        <figure class="col-lg-4 line-up-bands">
            <img class="full-img" src="assets/images/dad.jpg" alt="dad">
            <figcaption>
                <p>D-A-D</p>
                <p>Torsdag kl. 23:00</p>
            </figcaption>
        </figure> -->
    </div>
</div>
<?php require("assets/incl/footer.php")?>