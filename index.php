<?php
session_start();

require_once('app/helpers.php');

$title_page = 'HOME';
include_once './tpl/header.php';
?>

<main class="container-fluid flex-fill">
    <!-- PAGE HEADER -->
    <section id="main-top-content">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1 class="display-3 text-primary">
                    Welcome, Car Lovers <i class="bi bi-heart-fill ms-3"></i>
                </h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro facere tempore beatae doloremque a accusantium recusandae similique quasi, voluptatibus eum?
                </p>
                <p class="mt-4">
                    <a href="./signup.php" class="btn btn-outline-success btn-lg">
                        Join Us!
                    </a>
                </p>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="main-content container mt-5">

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">
                            Highlights
                        </strong>
                        <h3 class="mb-0">
                            Highlighted Cars
                        </h3>
                        <div class="mb-1 text-muted">
                            Nov 12
                        </div>
                        <p class="card-text mb-auto">
                            The most amazing cars you had ever whitest.
                        </p>
                        <a href="#" class="stretched-link">
                            Continue reading<i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img src="./images/highlight_cars.jpg" alt="highlighted cars" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success">
                            Priceless
                        </strong>
                        <h3 class="mb-0">
                            The most priceless cars
                        </h3>
                        <div class="mb-1 text-muted">
                            Nov 11
                        </div>
                        <p class="mb-auto">
                            The most priceless cars.
                        </p>
                        <a href="#" class="stretched-link">
                            Continue reading<i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img src="./images/priceless_cars.jpg" alt="Priceless Car" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include_once './tpl/footer.php'; ?>