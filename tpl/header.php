<?php
define('LOGO', 'i<i class="bi bi-truck mx-1"></i>Car');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iCar<?= isset($title_page) ? " | $title_page" : ''; ?></title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./js/script.js" defer></script>
</head>

<body class="d-flex flex-column min-vh-100">

    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary shadow-lg" aria-label="Fourth navbar example">
            <div class="container">

                <!-- LOGO -->
                <a class="navbar-brand" href="./">
                    <?= LOGO; ?>
                </a>

                <!-- BOOTSTRAP NAVBAR TOGGLER -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- NAVBAR LINKS -->
                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <!-- NAVBAR LEFT LINKS -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./blog.php">Blog</a>
                        </li>
                    </ul>
                    <!-- NAVBAR RIGHT LINKS -->
                    <ul class="navbar-nav ms-auto">
                        <?php if (!user_auth()) : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./signin.php">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./signup.php">Sign Up</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./profile.php"><?= $_SESSION['user_name']; ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./logout.php">Sign Out</a>
                            </li>
                        <?php endif; ?>

                    </ul>

                </div>
            </div>
        </nav>
    </header>