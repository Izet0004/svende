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
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light container">
            <a class="navbar-brand" href="#">
                <img src="/assets/images/logo2.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active pad-right">
                        <a class="nav-link buy-ticket a-remove white" href="#">KØB BILLET</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">NYHEDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">EVENTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CAMPS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">PRAKTISK INFO</a>
                    </li>
                    <?php if($auth->isMember() || $auth->isAdmin()) :?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Min side
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Mit program</a>
                            <a class="dropdown-item" href="#">Redigere Profil</a>
                            <a class="dropdown-item" href="?logout">Log ud</a>
                            <?php
                            if($auth->isAdmin()) { echo('<a class="dropdown-item" href="#">Admin</a>');}
                            ?>
                        </div>
                    </li>
                    <?php else :?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">LOGIN</a>
                    </li>
                    <?php endif;?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="material-icons">
                                search
                            </i></a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>