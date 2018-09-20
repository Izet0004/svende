<?php
require("assets/incl/header.php");
$newsObj = new News();

$newsId = 0;
$news = "";
if(isset($_GET["news_id"])){
    $newsId = filter_var($_GET["news_id"], FILTER_SANITIZE_STRING);
    if(empty($newsObj->getNewsSingle($newsId))){
        $newsId = 0;
    }
} else {
    $newsId = 0;
}

?>
<?php if($newsId <= 0): ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center p-3">NYHEDER</h1>
        </div>
    </div>
    <div class="row">
        <?php foreach($newsObj->listNews() as $new) :?>
        <div class="col-lg-4 news">
            <img src="/assets/data/fotos/indhold/<?php echo $new['img_path']?>" alt="art" class="full-img" height="250px">
            <div>
                <h4>
                    <?php echo $new['title']?>
                </h4>
                <p class="blur" maxlength="5">
                    <?php echo substr($new['description'], 0, 200)?>
                </p>
                <a class="btn-a-black text-center" href="news.php?news_id=<?php echo $new['id']?>">LÆS MERE</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php else: ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 news-details-wrapper">
            <div class="news-details-heading text-center">
                <h2 class="font-36 p-2">
                    <?php echo $newsObj->title?>
                </h2>
                <small>Forfatter:
                    <?php echo $newsObj->author ?>
                    <br>Dato:
                    <?php echo $newsObj->date_created?></small>
            </div>
            <div>
                <img src="/assets/data/fotos/indhold/<?php echo $newsObj->img_path?>" class="" alt="newsphoto" height="300px"
                    width="300px">
                <small class="block">Billede af:
                    <?php echo $newsObj->photograph?></small>
            </div>
            <div>
                <p><?php echo $newsObj->description?></p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php require("assets/incl/footer.php")?>