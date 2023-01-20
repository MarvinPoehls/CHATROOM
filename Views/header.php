<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Fatchip <?php echo $controller->getTitle(); ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
            <button class="navbar-toggler mx-3" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-3">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $controller->getUrl("index.php?controller=azubiTeam") ?>">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $controller->getUrl("index.php?controller=azubiList") ?>">Azubi Liste</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $controller->getUrl("index.php?controller=addAzubi") ?>">Azubi hinzufügen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $controller->getUrl("index.php?controller=login&action=logout") ?>">Logout</a>
                    </li>
                </ul>
            </div>
            <a class="float-end mx-3" href="https://www.fatchip.de/" target="_blank">
                <img height="40" width="40" class="float-end" src="https://www.fatchip.de/out/fatchip/img/fc_icon.png" alt="Fatchip Logo">
            </a>
        </nav>
        <div class="container bg-white shadow min-vh-100">
            <div class="row border-bottom pt-2 mb-4">
                <h1><?php echo $controller->getTitle(); ?></h1>
            </div>