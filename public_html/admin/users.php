<?php include_once("assets/incl/header.php")?>
<div class="row justify-content-end">
    <div class="col-lg-2 p-1">
        <button type="button" name="" id="" onclick="createUser()" class="btn btn-primary btn-lg btn-block">Create new</button>
    </div>
</div>
<div class="table-responsive" id="listContent">
    <div id="loader">
    </div>
</div>

<?php include_once("assets/incl/footer.php")?>
<script>
    listUsers()
</script>
<script src="assets/js/zip.js"></script>
