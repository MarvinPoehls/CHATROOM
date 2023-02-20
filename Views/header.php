<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $controller->getTitle(); ?></title>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"
                integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
                crossorigin="anonymous">
        </script>
        <script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?= $projectPath ?>css/styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    </head>
    <body class="h-100 overflow-hidden">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
            <div class="container-fluid">
                <a class="navbar-brand m-2 d-flex align-items-center" href="index.php">
                    <img src="https://i.postimg.cc/rwnHZBzV/Chatroom.png" width="30" height="30" class="" alt="logo">
                    <span class="ms-1">Chatroom</span>
                </a>
                <div class="navbar" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php if ($controller->getTitle() !== "Foyer") { ?>
                            <li class="nav-item text-end">
                                <a class="nav-link ms-4 p-0" href="index.php?username=<?= $controller->getUsername() ?>">
                                    <i class="bi bi-arrow-left-circle-fill text-white"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid h-100">