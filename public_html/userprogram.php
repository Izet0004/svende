<?php
$pageTitle = "Mit Program";
require("assets/incl/header.php");
$event = new Event();
$userEvent = new userprogram();
$date = new Date();
if(isset($_GET["delete"])){
    $eventId = filter_var($_GET["delete"], FILTER_SANITIZE_NUMBER_INT);
    $userEvent->deleteEvent($eventId, $auth->userId);
}
$userEventRelList = $userEvent->getUserEvents($auth->userId);
$eventIdList = [];
$eventList = [];
// DAYS
$wednesday = [];
$thursday = [];
$friday = [];
$saturday = [];
$debug = [];
foreach ($userEventRelList as $item) {
    $eventIdList[] = $item["event_id"];
}
// var_dump($eventIdList);
foreach($eventIdList as $eventId){
    $eventFound = $event->getEventSingle($eventId);
    switch (strtolower($date->getDay($eventFound["date"]))) {
        case "wednesday":
            $wednesday[] = $eventFound;
            break;
        case "thursday":
            // var_dump($eventFound);
            if(!empty($eventFound)){
                $thursday[] = $eventFound;
            }
            break;
        case "friday":
            $friday[] = $eventFound;
            break;
        case "saturday":
            $saturday[] = $eventFound;
            break;
        default:
            # code...
            break;
    }

}
// var_dump($debug);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center p-2">MIT PROGRAM</h2>
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
                <div class="userprogram-info-date <?php /*EDIT CLASS SCENE ID*/if($wedEvent["scene_id"]==1){ echo 'bg-red' ; }
                    elseif($wedEvent["scene_id"]==2){ echo 'bg-green' ; } elseif($wedEvent["scene_id"]==3){ echo 'bg-blue' ;
                    } elseif($wedEvent["scene_id"]==4){ echo 'bg-purple' ; } ?>">
                    <p class="white">
                        <?php echo mb_strtoupper($wedEvent["scene_title"], 'UTF-8')?> KL:
                        <?php echo $date->convertToTime($wedEvent["date"])?>
                    </p>
                </div>
                <div class="userprogram-info-title">
                    <p>
                        <?php echo $wedEvent["artist_name"]?>
                    </p>
                    <a class="a-remove-black" href="userprogram.php?delete=<?php echo $wedEvent['id']?>">
                    <i class="material-icons">
                        delete
                    </i>
                </a>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif; ?>

            <?php if(!empty($thursday)) : ?>
            <div class="userprogram-head white bg-dark p-2">
                <h2>Torsdag</h2>
            </div>
            <?php foreach($thursday as $thuEvent) : ?>
            <div class="userprogram-info-wrap">
                <div class="userprogram-info-date <?php /*EDIT CLASS SCENE ID*/if($thuEvent["scene_id"]==1){ echo 'bg-red' ; }
                    elseif($thuEvent["scene_id"]==2){ echo 'bg-green' ; } elseif($thuEvent["scene_id"]==3){ echo 'bg-blue' ;
                    } elseif($thuEvent["scene_id"]==4){ echo 'bg-purple' ; } ?>">
                    <p class="white">
                        <?php echo mb_strtoupper($thuEvent["scene_title"], 'UTF-8')?> KL:
                        <?php echo $date->convertToTime($thuEvent["date"])?>
                    </p>
                </div>
                <div class="userprogram-info-title">
                    <p>
                        <?php echo $thuEvent["artist_name"]?>
                    </p>
                    <a class="a-remove-black" href="userprogram.php?delete=<?php echo $thuEvent['id']?>"><i class="material-icons">
                        delete
                    </i></a>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif; ?>

            <?php if(!empty($friday)) : ?>
            <div class="userprogram-head white bg-dark p-2">
                <h2>Fredag</h2>
            </div>
            <?php foreach($friday as $friEvent) : ?>
            <div class="userprogram-info-wrap">
                <div class="userprogram-info-date <?php /*EDIT CLASS SCENE ID*/if($friEvent["scene_id"]==1){ echo 'bg-red' ; }
                    elseif($friEvent["scene_id"]==2){ echo 'bg-green' ; } elseif($friEvent["scene_id"]==3){ echo 'bg-blue' ;
                    } elseif($friEvent["scene_id"]==4){ echo 'bg-purple' ; } ?>">
                    <p class="white">
                        <?php echo mb_strtoupper($friEvent["scene_title"], 'UTF-8')?> KL:
                        <?php echo $date->convertToTime($friEvent["date"])?>
                    </p>
                </div>
                <div class="userprogram-info-title">
                    <p>
                        <?php echo $friEvent["artist_name"]?>
                    </p>
                    <a class="a-remove-black" href="userprogram.php?delete=<?php echo $friEvent['id']?>">
                    <i class="material-icons">
                        delete
                    </i>
                </a>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif; ?>

            <?php if(!empty($saturday)) : ?>
            <div class="userprogram-head white bg-dark p-2">
                <h2>Lørdag</h2>
            </div>
            <?php foreach($saturday as $satEvent) : ?>
            <div class="userprogram-info-wrap">
                <div class="userprogram-info-date <?php /*EDIT CLASS SCENE ID*/if($satEvent["scene_id"]==1){ echo 'bg-red' ; }
                    elseif($satEvent["scene_id"]==2){ echo 'bg-green' ; } elseif($satEvent["scene_id"]==3){ echo 'bg-blue' ;
                    } elseif($satEvent["scene_id"]==4){ echo 'bg-purple' ; } ?>">
                    <p class="white">
                        <?php echo mb_strtoupper($satEvent["scene_title"], 'UTF-8')?> KL:
                        <?php echo $date->convertToTime($satEvent["date"])?>
                    </p>
                </div>
                <div class="userprogram-info-title">
                    <p>
                        <?php echo $satEvent["artist_name"]?>
                    </p>
                    <a class="a-remove-black" href="userprogram.php?delete=<?php echo $satEvent['id']?>">
                    <i class="material-icons">
                        delete
                    </i>
                </a>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require("assets/incl/footer.php")?>
<script>
    $(document).ready(function () {
        $(".a-remove-black").click(function () {
            return confirm("Vil du slette " + this.id + "?");
        });
    });
</script>