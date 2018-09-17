<?php include_once("assets/incl/header.php");
$info = new Overview();?>
<section class="row dash-info">
    <div class="siteInfo col-lg-3">
        <div>
            <h1>Total users</h1>
            <p>
                <?php echo $info->showCount("user_id", "user"); ?>
            </p>
        </div>
    </div>
    <div class="siteInfo col-lg-3">
        <div>
            <h1>Total users</h1>
            <p>
                <?php echo $info->showCount("user_id", "user"); ?>
            </p>
        </div>
    </div>
    <div class="siteInfo col-lg-3">
        <div>
            <h1>Total users</h1>
            <p>
                <?php echo $info->showCount("user_id", "user"); ?>
            </p>
        </div>
    </div>
    <div class="siteInfo col-lg-3">
        <div>
            <h1>Total users</h1>
            <p>
                <?php echo $info->showCount("user_id", "user"); ?>
            </p>
        </div>
    </div>
</section>
<?php include_once("assets/incl/footer.php")?>