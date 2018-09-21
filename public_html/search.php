<?php
$pageTitle = "Søg";
require("assets/incl/header.php");
$events = new Event();
if(isset($_GET["search"])){
    $search = filter_var($_GET["search"], FILTER_SANITIZE_STRING);
} else {
    $search = "";
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="p-2 text-center">Søg</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 search">
            <form method="GET" class="search-form">
                <div class="form-group">
                    <label for="search"></label>
                    <input type="text" class="form-control" name="search" id="" aria-describedby="helpId" placeholder="">
                </div>
                <button type="submit" class="btn btn-primary bg-blue">Søg</button>
            </form>
        </div>
    </div>
    <?php if(!empty($search)): ?>
    <?php foreach($events->getEventByLike($search) as $event) : ?>
    <div class="row">
        <div class="col-lg-12 col-sm-2 search-output">
            <a class="a-remove-black" href="artistdetails.php?event_id=<?php echo $event['id']?>">
                <div>
                    <img src="/assets/data/fotos/artister/<?php echo $event['img_path']?>" alt="bandlogo" height="150px"
                        width="150px">
                </div>
                <div>
                    <h2>
                        <?php echo $event["name"]?>
                    </h2>
                </div>
                <div>
                    <p>
                        <?php echo substr($event["description"], 0, 200)?>
                    </p>
                </div>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>

<script src="assets/js/modal.js"></script>
<?php require("assets/incl/footer.php")?>