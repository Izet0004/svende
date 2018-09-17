<?php include_once("init.php")?>
<!doctype html>
<html lang="en">

<head>
    <title>
        <?php echo $pageTitle?>
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

</head>

<body>
    <header>
        <nav class="container navbar navbar-expand-lg navbar-dark bg-black">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 weight-1000">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">FORSIDEN</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">ARRANGEMENTER</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">KONTAKT</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2 input-fix bg-green" type="search" placeholder="søg" aria-label="søg">
                    <button type="submit" name="" id="" class="btn btn-primary searchBtn btn-green weight-1000" btn-lg>Søg</button>
                </form>
            </div>
        </nav>
    </header>
    <?php if($auth->isMember()): ?>
    <?php $user = new User();
    $userDetails = $user->getUserSingle($auth->userId)?>
    <div class="container">
        <section class="row">
            <div class="col-lg-7 bg-green">
                <h1 class="font-64 weight-1000">Vandrestøvlen</h1>
            </div>
            <div class="col-lg-5 logged">
                <div>
                    <small>DU ER LOGGET IND SOM</small>
                    <h3 class="weight-1000">
                        <?php echo $userDetails["first_name"] . ' ' . $userDetails["last_name"]?>
                    </h3>
                </div>
                <form class="form" method="POST" action="index.php">
                    <a href="userprofile.php/?profile_id=<?php echo $auth->userId?>" class="weight-1000 font-10">RET BRUGERINDSTILLINGER</a>
                    <div class="form-group">
                        <button type="submit" name="logout" id="" class="btn btn-primary btn-orange" btn-lg>LOG UD</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <?php elseif($auth->isAdmin()): ?>
    <?php $user = new User();
    $userDetails = $user->getUserSingle($auth->userId)?>
    <div class="container">
        <section class="row">
            <div class="col-lg-7 bg-green">
                <h1 class="font-64 weight-1000">Vandrestøvlen</h1>
            </div>
            <div class="col-lg-5 logged">
                <div>
                    <small>DU ER LOGGET IND SOM</small>
                    <h3 class="weight-1000">
                        <?php echo $userDetails["first_name"] . ' ' . $userDetails["last_name"] ?> (ADMIN)</h3>
                </div>
                <form class="form" method="POST" action="index.php">
                    <a href="/admin/index.php" class="weight-1000 font-10">ADMIN PANEL</a>
                    <div class="form-group">
                        <button type="submit" name="logout" id="" class="btn btn-primary btn-orange" btn-lg>LOG UD</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <?php else :?>
    <div class="container">
        <section class="row">
            <div class="col-lg-7 bg-green">
                <h1 class="font-64 weight-1000">Vandrestøvlen</h1>
            </div>
            <div class="col-lg-5">
                <div class="row profile">
                    <h3 class="p-1 weight-1000">DIN PROFIL</h3>
                    <div>
                        <ul class="font-10">
                            <li>
                                <b>OPRET BRUGER
                                    <b>
                            </li>
                            <li>
                                <b>GLEMT PASSWORD</b>
                            </li>
                        </ul>
                    </div>
                </div>
                <form class="form-inline row" method="POST" action="index.php">
                    <div class="form-group">
                        <input type="text" class="form-control-sm input-fix" name="username" id="" aria-describedby="helpId" placeholder="Brugernavn">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control-sm input-fix" name="password" id="" aria-describedby="helpId" placeholder="Adgangskode">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="" id="" class="btn btn-primary btn-green" btn-lg>Login</button>
                    </div>
                    <?php echo '<span class="red">'.$errorMsg.'</span>'?>
                </form>
            </div>
        </section>
    </div>
    <?php endif;?>