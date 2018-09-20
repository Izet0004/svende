<?php
$pageTitle = "MEDIESUSET";
require("assets/incl/header.php");
$newsObj = new News();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 p-0">
            <img src="assets/images/indexhero.jpg" alt="hero" class="full-img">
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center p-3">NYHEDER</h1>
        </div>
    </div>
    <div class="row">
        <?php foreach($newsObj->listNews8() as $new) :?>
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
        <div class="col-lg-12 newsarchieve">
            <a href="news.php" class="p-0 m-0 a-remove">NYHEDSAKRIV</a>
        </div>
    </div>
</div>
<?php require("assets/incl/footer.php")?>