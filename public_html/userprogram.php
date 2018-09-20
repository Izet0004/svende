<?php
$pageTitle = "Mit Program";
require("assets/incl/header.php");
$event = new Event();
$userEvent = new userprogram();
$date = new Date();
$userEventRelList = $userEvent->getUserEvents($auth->userId);
$eventIdList = [];
$eventList = [];
// DAYS
$wednesday = [];
$thursday = [];
$friday = [];
$sunday = [];

foreach ($userEventRelList as $item) {
    $eventIdList[] = $item["event_id"];
}
foreach($eventIdList as $eventId){
    $eventFound = $event->getEventSingle($eventId);
    switch (strtolower($date->getDay($eventFound["date"]))) {
        case "wednesday":
            $wednesday[] = $eventFound;
            break;
        case "thursday":
            $thursday[] = $eventFound;
            break;
        case "friday":
            $friday[] = $eventFound;
            break;
        case "sunday":
            $wednesday[] = $eventFound;
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
            <h2>MIT PROGRAM</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php if(!empty($wednesday)) : ?>
            <div class="userprogram-head white bg-dark p-2">
                <h2>Onsdag</h2>
            </div>
            <?php foreach($wednesday as $wedEvent) : ?>
            <div class="userprogram-info-wrap">
                <div class="userprogram-info-date">
                <p><?php echo $wedEvent["scene_title"]?> KL: <?php echo $wedEvent["date"]?></p>
                </div>
                <div class="userprogram-info-title">
                    <p><?php echo $wedEvent["artist_name"]?></p>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif; ?>

            <?php if(!empty($thursday)) : ?>
            <div>Torsdag</div>
            <?php foreach($thursday as $thuEvent) : ?>
            <?php var_dump($thuEvent) ?>
            <?php endforeach;?>
            <?php endif; ?>

            <?php if(!empty($friday)) : ?>
            <div>Fredag</div>
            <?php foreach($friday as $friEvent) : ?>
            <?php var_dump($friEvent) ?>
            <?php endforeach;?>
            <?php endif; ?>

            <?php if(!empty($sunday)) : ?>
            <div>Lørdag</div>
            <?php foreach($sunday as $sunEvent) : ?>
            <?php var_dump($sunEvent) ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require("assets/incl/footer.php")?>