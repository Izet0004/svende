<?php
$pageTitle = "Program";
require("assets/incl/header.php");
if(isset($_GET["day"])){
    $day = filter_var($_GET["day"], FILTER_SANITIZE_STRING);
} else {
    $day = "Wednesday";
}
$event = new Event();
$dateTime = new Date();
$eventsFound = $event->getEventByDay($day);
$red = [];
$blue = [];
$green = [];
$purple = [];

foreach($eventsFound as $event){
    switch ($event["scene_id"]) {
        case 1:
            $red[] = $event;
            break;
        case 2:
            $green[] = $event;
            break;
        case 3:
            $blue[] = $event;
            break;
        case 4:
            $purple[] = $event;
            break;    
        default:
            # code...
            break;
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center p-2">PROGRAM</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 program">
            <ul>
                <li><a href="?day=Wednesday" class="a-remove">ONSDAG</a></li>
                <li><a href="?day=Thursday" class="a-remove">TORSDAG</a></li>
                <li><a href="?day=Friday" class="a-remove">FREDAG</a></li>
                <li><a href="?day=Saturday" class="a-remove">LØRDAG</a></li>
            </ul>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 program-info">
            <p class="bg-red white program-info-heading">RØD SCENE</p>
            <table class="table">
                <tbody class="border-top-bot-red">
                    <?php if(empty($red)) :?>
                    <p class="text-center">Ingen er på denne scene.</p>
                    <?php else: ?>
                    <?php foreach ($red as $event) : ?>
                    <tr>
                        <th class="pad-sides vert-middle font-32" scope="row">
                            <?php echo $dateTime->convertToTime($event["date"])?>
                        </th>
                        <td class="full-width font-36">
                            <?php //var_dump($event["id"]);?>
                            <a href="artistdetails.php?event_id=<?php echo $event['id']?>" class="a-remove-black">
                                <?php echo $event["name"]?><span class="font-14 block">
                                    <?php echo $event["scene_title"]?></span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-10 program-info">
            <p class="bg-blue white program-info-heading">BLÅ SCENE</p>
            <table class="table">
                <tbody class="border-top-bot-green">
                    <?php if(empty($blue)) :?>
                    <p class="text-center">Ingen er på denne scene.</p>
                    <?php else: ?>
                    <?php foreach ($blue as $event) : ?>
                    <tr>
                        <th class="pad-sides vert-middle font-32" scope="row">
                            <?php echo $dateTime->convertToTime($event["date"])?>
                        </th>
                        <td class="full-width font-36">
                            <a href="artistdetails.php?event_id=<?php echo $event['id']?>" class="a-remove-black">
                                <?php echo $event["name"]?><span class="font-14 block">
                                    <?php echo $event["scene_title"]?></span></td>
                        </a>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-10 program-info">
            <p class="bg-green white program-info-heading">GRØN SCENE</p>
            <table class="table">
                <tbody class="border-top-bot-green">
                    <?php if(empty($green)) :?>
                    <p class="text-center">Ingen er på denne scene.</p>
                    <?php else: ?>
                    <?php foreach ($green as $event) : ?>
                    <tr>
                        <th class="pad-sides vert-middle font-32" scope="row">
                            <?php echo $dateTime->convertToTime($event["date"])?>
                        </th>
                        <td class="full-width font-36">
                            <a href="artistdetails.php?event_id=<?php echo $event['id']?>" class="a-remove-black">
                                <?php echo $event["name"]?><span class="font-14 block">
                                    <?php echo $event["scene_title"]?></span></td>
                        </a>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-10 program-info">
            <p class="bg-purple white program-info-heading">LILLA SCENE</p>
            <table class="table">
                <tbody class="border-top-bot-green">
                    <?php if(empty($purple)) :?>
                    <p class="text-center">Ingen er på denne scene.</p>
                    <?php else: ?>
                    <?php foreach ($purple as $event) : ?>
                    <tr>
                        <th class="pad-sides vert-middle font-32" scope="row">
                            <?php echo $dateTime->convertToTime($event["date"])?>
                        </th>
                        <td class="full-width font-36">
                            <a href="artistdetails.php?event_id=<?php echo $event['id']?>" class="a-remove-black">
                                <?php echo $event["name"]?><span class="font-14 block">
                                    <?php echo $event["scene_title"]?></span></td>
                        </a>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="assets/js/modal.js"></script>
<?php require("assets/incl/footer.php")?>